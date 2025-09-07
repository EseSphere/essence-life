const CACHE_NAME = 'essence-life-v1';
const OFFLINE_FALLBACK = new URL('offline.html', self.registration.scope).toString();
const MAX_CONCURRENT_FETCHES = 3;

// Install: cache offline fallback
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => cache.add(OFFLINE_FALLBACK))
            .catch(err => console.warn('Offline fallback failed to cache:', err))
            .then(() => self.skipWaiting())
    );
});

// Activate: clean up old caches
self.addEventListener('activate', event => {
    event.waitUntil(
        (async () => {
            const cacheNames = await caches.keys();
            await Promise.all(
                cacheNames.filter(name => name !== CACHE_NAME)
                          .map(name => caches.delete(name))
            );
            await self.clients.claim();
        })()
    );
});

// Queue system for caching pages
const cachedURLs = new Set();
const queue = [];
let activeFetches = 0;

// Listen for messages from client
self.addEventListener('message', event => {
    if (event.data.action === 'cacheLinks') {
        event.data.links.forEach(link => enqueue(link));
        processQueue();
    }
});

function enqueue(url) {
    if (!cachedURLs.has(url)) {
        cachedURLs.add(url);
        queue.push(url);
    }
}

function processQueue() {
    while (activeFetches < MAX_CONCURRENT_FETCHES && queue.length > 0) {
        const url = queue.shift();
        activeFetches++;
        cachePage(url).finally(() => {
            activeFetches--;
            processQueue();
        });
    }
}

// Cache page and parse links recursively
async function cachePage(url) {
    try {
        const cache = await caches.open(CACHE_NAME);
        const response = await fetch(url);

        if (!response.ok || response.type !== 'basic') return;

        // Clone for caching and text parsing
        const responseForCache = response.clone();
        const responseForText = response.clone();

        await cache.put(url, responseForCache);

        const text = await responseForText.text();
        const links = Array.from(text.matchAll(/href=["'](.*?)["']/g))
            .map(match => new URL(match[1], url).href)
            .filter(href => href.startsWith(location.origin));

        links.forEach(link => enqueue(link));
        processQueue();
    } catch (err) {
        console.warn('Failed to cache', url, err);
    }
}

// Fetch handler: offline-first
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                if (response) return response;

                return fetch(event.request)
                    .then(netResp => {
                        if (event.request.method === 'GET' && netResp.ok) {
                            const netRespClone = netResp.clone();
                            caches.open(CACHE_NAME).then(cache => cache.put(event.request, netRespClone));
                        }
                        return netResp;
                    })
                    .catch(() => {
                        if (event.request.headers.get('accept')?.includes('text/html')) {
                            return caches.match(OFFLINE_FALLBACK);
                        }
                    });
            })
    );
});
