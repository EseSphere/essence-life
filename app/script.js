if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('sw.js')
        .then(() => console.log('Service Worker Registered'))
        .catch(err => console.error('SW registration failed:', err));
}

// IndexedDB setup to store links
let db;
const request = indexedDB.open('CachedLinksDB', 1);

request.onupgradeneeded = event => {
    db = event.target.result;
    if (!db.objectStoreNames.contains('links')) {
        db.createObjectStore('links', { keyPath: 'url' });
    }
};

request.onsuccess = event => {
    db = event.target.result;
    navigator.serviceWorker.ready.then(() => captureLinks());
};

request.onerror = event => {
    console.error('IndexedDB error:', event.target.errorCode);
};

// Capture all internal links and send to SW
function captureLinks() {
    if (!navigator.serviceWorker.controller || !db) return;

    const links = Array.from(document.querySelectorAll('a'))
        .map(a => a.href)
        .filter(href => href.startsWith(location.origin));

    if (links.length === 0) return;

    // Store in IndexedDB
    const tx = db.transaction('links', 'readwrite');
    const store = tx.objectStore('links');
    links.forEach(url => store.put({ url }));

    // Send to SW for caching
    navigator.serviceWorker.controller.postMessage({
        action: 'cacheLinks',
        links: links
    });
}

// Observe dynamic links
let sendTimeout;
const observer = new MutationObserver(() => {
    clearTimeout(sendTimeout);
    sendTimeout = setTimeout(() => captureLinks(), 500);
});
observer.observe(document.body, { childList: true, subtree: true });

// Initial capture on page load
window.addEventListener('load', () => captureLinks());
