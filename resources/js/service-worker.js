const version = 'v1';
const cacheName = `offline-${version}`;
const v = new URL(location).searchParams.get('v');

const main = [
    '/',
    '/js/app.js?v=' + v,
    '/css/app.css?v=' + v,
];

self.addEventListener('install', e => {
    e.waitUntil(
        caches.open(cacheName).then(cache => {
            return cache.addAll(main).then(() => self.skipWaiting());
        }),
    );
});

self.addEventListener('activate', event => {
    event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', event => {
    if (event.request.method !== 'GET') {
        return;
    }

    event.respondWith(
        fetch(event.request).
            then(response => {
                const cacheCopy = response.clone();

                caches.open(cacheName).then(cache => {
                    cache.put(event.request, cacheCopy);
                });

                return response;
            }).
            catch(() => {
                return caches.open(cacheName).then(cache => {
                    return cache.match(event.request).
                        then(response => response);
                });
            }),
    );
});
