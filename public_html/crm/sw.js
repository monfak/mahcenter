/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
const staticCacheName = 'parsvt-site-static-v2';
const preLoad = function () {
    return caches.open(staticCacheName).then(function (cache) {
        return cache.addAll(filesToCache);
    });
};
self.addEventListener("install", function (event) {
    event.waitUntil(preLoad());
});
const filesToCache = [
        'modules/ParsVT/errors/?error=404',
        'modules/ParsVT/errors/?error=500',
        'modules/ParsVT/errors/?error=504',
        'layouts/v7/lib/todc/css/bootstrap.min.css',
        'layouts/v7/lib/font-awesome/css/font-awesome.min.css',
        'modules/ParsVT/resources/styles/css/ErrorPages.css',
        'layouts/v7/lib/jquery/jquery.min.js',
        'layouts/v7/modules/ParsVT/resources/EPages.js',
    ];
const checkResponse = function (request) {
    return new Promise(function (fulfill, reject) {
        fetch(request).then(function (response) {
            if (response.status !== 404) {
                fulfill(response);
            } else {
                reject();
            }
        }, reject);
    });
};
const addToCache = function (request) {
    return caches.open(staticCacheName).then(function (cache) {
        if (request.url.startsWith('chrome-extension') ||
            request.url.includes('extension') ||
            !(request.url.indexOf('http') === 0)
        ) return;
        return fetch(request).then(function (response) {
            return cache.put(request, response);
        });
    });
};
const returnFromCache = function (request) {
    return caches.open(staticCacheName).then(function (cache) {
        return cache.match(request).then(function (matching) {
            if (!matching || matching.status === 404) {
                return cache.match("modules/ParsVT/errors/?error=404");
            } else if (!matching || matching.status === 500) {
                return cache.match("modules/ParsVT/errors/?error=500");
            } else if (!matching || matching.status === 504) {
                return cache.match("modules/ParsVT/errors/?error=504");
            } else {
                return matching;
            }
        });
    });
};
self.addEventListener("fetch", function (event) {
    let directotyCache = [
        'test/javascript_c/.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'layouts/v7/lib/.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'libraries/fullcalendar/.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'libraries/garand-sticky/.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'libraries/guidersjs/.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'layouts/v7/skins/.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'libraries/jquery/.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'libraries/bootstrap/.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'modules/ParsVT/resources/styles/css/.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'modules/ParsVT/resources/styles/fonts/.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'modules/ParsVT/resources/keyboard/.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'layouts/v7/modules/ParsVT/resources/.*./.*.(css|js|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
        'layouts/v7/modules/.*./resources/.*.(css|eot|ttf|otf|woff|woff2|jpg|png|gif|svg|less)',
    ];
    event.respondWith(checkResponse(event.request).catch(function () {
        return returnFromCache(event.request);
    }));
    if (!event.request.url.startsWith('http')) {
        event.waitUntil(addToCache(event.request));
    }
    var matcher = false;
    directotyCache.forEach(function (Item) {
        matcher = new RegExp(Item, 'g');
        if (matcher.test(event.request.url)) {
            event.waitUntil(addToCache(event.request));
        }
    }, this);
});
self.addEventListener('activate', evt => {
    evt.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(keys
                .filter(key => key !== staticCacheName)
                .map(key => caches.delete(key))
            );
        })
    );
});