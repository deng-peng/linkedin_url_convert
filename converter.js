function convertCanonicalUrl(url) {

    var id, parts, pos;

    url = url.toLowerCase();
    pos = url.indexOf('linkedin');
    url = url.substring(pos, url.length); // strip everything before linkedin
    url = url.split('?')[0];              // remove any query parameters
    parts = url.split('/');               // split url into parts

    if (url.lastIndexOf('/') === url.length - 1) { // strip trailing slash from url
        url = url.substring(0, url.length - 1);
    }
    if (parts.length === 4 && parts[3].length === 2) { //shortcut for language
        url = parts[0].toLowerCase() + '/' + parts[1] + '/' + parts[2];
    }
    else if (parts.length > 3 && parts[4] !== undefined) {

        // urls with ids have more parts
        if (parts[4].length === 2) {
            parts[4] = '0' + parts[4];        // see: http://git.io/vRBcL
        }

        if (parts[5].length === 2) {
            parts[5] = '0' + parts[5];        // see: http://git.io/vRBcL
        }

        if (parts[5].length === 1) {
            parts[5] = '00' + parts[5];        // see: http://git.io/vRBcL
        }

        if (parts[3] === '0')
            parts[3] = '';

        id = parts[5] + parts[4] + parts[3]; // see example above
        url = parts[0] + '/' + parts[1] + '/' + parts[2] + '-' + id;
    }

    return 'https://www.' + url.replace('pub', 'in'); // pub are for Search Engines

}