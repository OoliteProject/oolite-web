import mustache from "https://cdnjs.cloudflare.com/ajax/libs/mustache.js/4.2.0/mustache.min.js";

const ibp = 'https://addons.oolite.space/i/';

const introBanner = (()=>{
    const slideCount = 10;

    const _init = (config) => {
        let html = '', arr = [];
        for ( let i = 0; i < config.introBannerSlideCount; i++ ) arr[i]=i+1;
        shuffleArray(arr);
        for ( let i = 0; i < slideCount; i++ ) {
            let v = arr[i];
            let n = v>999?v:(v>99?'0'+v:(v>9?'00'+v:'000'+v));
            let cls = i === 0 ? ' active' : '';
            html += `<div class="carousel-item${cls}"><img src="${ibp}intro-banner/${n}.jpg"></div>`;
        }
        $push( $q('#intro-banner-items .carousel-inner'), html );
    };

    return ({
        init: _init,
    });
})();

const titleManager = (()=>{
    let titleHeaders;

    const pageTitles = {
        'home':      'Oolite: an open-world space opera',
        'whatsnew':  '',
        'download':  'Download Oolite',
        'started':   'Getting Started with Oolite',
        'gallery':   'Screenshots',
        'oxp':       'Oolite Expansion Packs',
        'community': 'Oolite Community'
    };

    const _init = (config) => {
        titleHeaders = $qq('#title-wrapper .p-title, head title');
        pageTitles['whatsnew'] = `What&#39;s New in Oolite ${config.stableVersion.num} (stable)`;
        _set();
    };

    const _set = ( page, title ) => {
        if (page) {
            if (title) pageTitles[page] = title;
            $html(titleHeaders, pageTitles[page]);
        }
        else {
            _set('home');
        }
    };

    return ({
        init: _init,
        set:  _set
    });
})();

const mainMenu = (()=>{
    let currentPage = 'home',
    quoteEl, citeEl,
    fScroll = false;

    const _init = (config) => {
        $on( '#navigation .nav-link', 'show.bs.tab', el => {
            let t = $attr( el, 'data-bs-target' );
            currentPage = t.split('-')[1];
            titleManager.set(currentPage);
            if ( fScroll || window.pageYOffset > 500 ) scrollTop(1);
            fScroll = false;
            _setRandomQuote();
            if ( currentPage === 'home' ) {
                rmUrlHash();
            }
            else {
                window.location.hash = currentPage;
            }
        }, false );
        quoteEl = $q('#navigation blockquote');
        citeEl  = $q('#navigation cite');
        _setRandomQuote();
        if ( window.location.hash ) {
            _show(window.location.hash.substring(1));
        }
    };

    const _setRandomQuote = () => {
        let j = Math.floor(Math.random() * window.FICTIONS_DATA.length);
        let q = window.FICTIONS_DATA[j];
        quoteEl.innerHTML = '“'+q[0]+'”';
        citeEl.innerHTML  = '&mdash; from '+q[1];
    };

    const _show = (name, forceScroll = false) => {
        fScroll = forceScroll;
        const tb = new bootstrap.Tab(`#nav-${name}-tab`);
        tb.show();
    };

    const _getCurrent = () => {
        return ''+currentPage;
    };

    const _isCurrent = (page) => {
        return !!(page === currentPage);
    };

    return ({
        init:        _init,
        currentPage: _getCurrent,
        show:        _show,
        isCurrent:   _isCurrent
    });
})();

const versionNavigator = (()=>{
    let controls, btnSet = 0, loaded = {},
    carousel, container, versions,
    stableIdx, nightlyIdx, currentIdx = 0, maxIdx;

    const _fetchVersion = () => {
        fetchHTML( $q(`.wn-${currentIdx}`, container), `/html/whatsnew/${versions[currentIdx][1]}` );
        loaded[currentIdx] = true;
    };

    const _checkBtns = () => {
        let t = currentIdx === 0 ? 1
            : currentIdx === 1 ? 2
            : currentIdx < stableIdx ? 3
            : currentIdx === stableIdx ? ( currentIdx === maxIdx ? 5 : 4 )
            : currentIdx > stableIdx ? 6
            : 1;
        if ( btnSet === t ) return;
        $setClass( controls, 'version-navigator btn-set-'+(btnSet=t) );
    };

    const _shift = (shift) => {
        let t = currentIdx + shift;
        if ( t < 0 ) t = 0;
        if ( t > maxIdx ) t = maxIdx;
        if ( currentIdx === t ) return;
        currentIdx = t;
        _checkBtns();
        if ( ! loaded[currentIdx] ) _fetchVersion();
        let v = versions[currentIdx];
        if ( mainMenu.isCurrent('whatsnew') ) titleManager.set( 'whatsnew', `What's New in Oolite ${v[0]} (${v[3]})` );
        carousel.to(currentIdx);
    };

    const _init = (config) => {
        const vnavTop = $q('#vnav-top');
        const vnavBottom = $q('#vnav-bottom');
        const tpl = $q('#version-navigator-tpl').content;

        vnavTop.append( tpl.cloneNode(true) );
        vnavBottom.append( tpl.cloneNode(true) );

        controls = $qq('#page-whatsnew .version-navigator');
        container = $q('#whatsnew-items');
        carousel = new bootstrap.Carousel(container, {touch:false});

        versions = config.versions;
        let sv = config.stableVersion;
        stableIdx  = sv.index;
        maxIdx = versions.length - 1;
        let itemsHtml = '';
        for ( let i = 0; i <= maxIdx; i++ ) {
            if ( versions[i][3] === 'nightly' ) nightlyIdx = i;
            let cls = i == stableIdx ? ' active' : '';
            itemsHtml += `<div class="carousel-item${cls}"><div class="whatsnew-item wn-${i}"></div></div>`;
        }
        $push( $q('.carousel-inner', container) , itemsHtml );

        _shift(stableIdx);

        $on( '.version-navigator .vnav-first',   'click', () => _shift(-currentIdx) );
        $on( '.version-navigator .vnav-prev',    'click', () => _shift(-1) );
        $on( '.version-navigator .vnav-next',    'click', () => _shift(1) );
        $on( '.version-navigator .vnav-last',    'click', () => _shift( stableIdx - currentIdx ) );
        $on( '.version-navigator .vnav-nightly', 'click', () => _shift( maxIdx - currentIdx ) );
    };

    return ({
        init: _init,
    });
})();

const galleryManager = (()=>{
    const basicSlides = [
        ["Main.png",      "Oolite's start screen includes an expansion pack manager and quick reference guides."],
        ["Tutorial.png",  "A tutorial introduces the basics of piloting, combat, and travel."],
        ["Maraus.png",    "Oolite has over 2000 systems to explore. This is Maraus, a wealthy industrial world."],
        ["Contracts.png", "A route finder allows long journeys to be planned - great for transport contracts."],
        ["Station.png",   "Orbital stations provide facilities and protection to pilots."],
        ["Equipment.png", "A wide range of equipment is available to increase your chances of survival."]
    ];

    let basicWrappers, basicCaption, basicCarousel, basicSlide = 0,
    oxpThumbsCarousel, oxpThumbsInner, oxpThumbsLoaded = {},
    oxpCaption, oxpInner, oxpCarousel,
    oxpSlide = 0, oxpSlideMove = 0, oxpPage = 0, oxpPageSize = 6, oxpMaxPage;

    const _activateSet = ( el, set ) => {
        if ( el.classList.contains('active') ) return;
        $tglClass('#gallery-buttons .ctrl-btn', 'active' );
        $setClass('#page-gallery .gallery', `gallery ${set}-set`);
    };

    const _basicTo = ( idx, noCarousel ) => {
        basicCaption.innerHTML = basicSlides[idx][1];
        if ( ! noCarousel ) basicCarousel.to(+idx);
        $rmClass(basicWrappers, 'active');
        $addClass(`.basic-thumbs .thumb-wrapper:nth-child(${++idx})`, 'active');
    };

    const _initBasic = (config) => {
        basicCaption  = $q('#page-gallery .basic-caption');
        basicCarousel = $q('#gallery-basic-items');

        let basicThumbs = $q('#page-gallery .basic-thumbs');
        let basicInner  = $q('.carousel-inner', basicCarousel);

        basicCarousel.addEventListener('slide.bs.carousel', event => _basicTo(event.to, true) );

        basicCarousel = new bootstrap.Carousel(basicCarousel);

        const bp = `${ibp}gallery/basic/`;
        let html1 = '', html2 = '';
        for ( let i = 0; i < basicSlides.length; i++ ) {
            let cls = i === 0 ? ' active' : '';
            let l1 = `${bp}small/`+basicSlides[i][0];
            let l2 = `${bp}large/`+basicSlides[i][0];
            html1 += `<div class="thumb-wrapper${cls}"><img data-idx="${i}"src="${l1}"/></div>`;
            html2 += `<div class="carousel-item${cls}"><a target="_blank"href="${l2}"><img src="${l2}"/></a></div>`;
        }
        $push( basicThumbs, html1 );
        $push( basicInner, html2 );

        basicWrappers = $qq('.thumb-wrapper', basicThumbs);

        $on( basicWrappers, 'click', el => _basicTo( el.dataset.idx ) );

        _basicTo(0);
    };

    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 

    const _oxpSetActiveThumb = ( idx ) => {
        oxpSlide = +idx;
        const absIdx = oxpPage*oxpPageSize+oxpSlide;
        oxpCaption.innerHTML = window.GALLERY_DATA[absIdx][1];

        $rmClass('#gallery-oxp-thumbs .thumb-wrapper.active', 'active');
        $addClass($q(`.carousel-item:nth-child(${+oxpPage+1}) .thumb-wrapper:nth-child(${+idx+1})`, oxpThumbsInner), 'active');
    };

    const _oxpSetActiveSlide = ( idx ) => {
        oxpSlide = +idx;
        oxpCarousel.to(+oxpSlide);
    };

    const _oxpLoadThumbsPage = ( idx ) => {
        if ( oxpThumbsLoaded[idx] ) return;
        const bp = `${ibp}gallery/oxp/`;
        const offset = idx*oxpPageSize;

        let html = '';
        for ( let i = 0; i < oxpPageSize; i++ ) {
            let absIdx = offset+i;
            if ( absIdx >= window.GALLERY_DATA.length ) break;
            let l = `${bp}small/`+window.GALLERY_DATA[absIdx][0];
            html += `<div class="thumb-wrapper"><img data-idx="${i}"src="${l}"/></div>`;
        }
        if (html)
            $push( oxpThumbsInner, `<div class="carousel-item"><div class="thumbs oxp-thumbs">${html}</div></div>` );

        $on( $qq('.thumb-wrapper', oxpThumbsInner.lastChild), 'click', el => _oxpSetActiveSlide( el.dataset.idx ) );

        oxpThumbsLoaded[idx] = true;
    };

    const _oxpSetPageSlides = () => {
        const bp = `${ibp}gallery/oxp/`;
        const offset = oxpPage*oxpPageSize;

        let hrefs  = $qq('a', oxpInner);
        let imgs   = $qq('img', oxpInner);

        for ( let i = 0; i < oxpPageSize; i++ ) {
            let absIdx = offset+i;
            let ok = !!(absIdx < window.GALLERY_DATA.length);
            let ln = ok ? `${bp}large/`+window.GALLERY_DATA[absIdx][0] : '';
            $attr( hrefs[i], 'href', ln );
            $attr( imgs[i],  'src',  ln );
        }
    };

    const _oxpSlideBtn = (button) => {
        if (oxpSlideMove) return;
        if ( button.dataset.bsSlide === 'prev' ) {
            if ( oxpSlide === 0 && oxpPage > 0 ) _oxpChangePageBySlideBtn(-1);
        }
        else {
            if ( oxpSlide === oxpPageSize-1 && oxpPage < oxpMaxPage ) _oxpChangePageBySlideBtn(1);
        }
    };

    const _oxpChangePageBySlideBtn = (delta) => {
        oxpPage += delta;
        oxpThumbsCarousel.to(oxpPage);
        _oxpSetPageSlides();
        _oxpSetActiveSlide( delta < 0 ? oxpPageSize-1 : 0 );
        oxpSlideMove = 0;
    };

    const _initOxp = (config) => {
        oxpCaption = $q('#page-gallery .oxp-caption');
        oxpCarousel = $q('#gallery-oxp-items');
        oxpInner  = $q('.carousel-inner', oxpCarousel);

        oxpThumbsCarousel = $q('#gallery-oxp-thumbs');
        oxpThumbsInner = $q('.carousel-inner', oxpThumbsCarousel);

        oxpThumbsCarousel.addEventListener('slide.bs.carousel', event => {
            _oxpSetPageSlides( oxpPage = event.to );
        });

        oxpThumbsCarousel.addEventListener('slid.bs.carousel', event => {
            let idx = event.from < event.to ? 0 : oxpPageSize-1;
            _oxpSetActiveThumb(idx);
            _oxpSetActiveSlide(idx);
            if ( oxpPage < oxpMaxPage ) _oxpLoadThumbsPage(oxpPage+1);
        });
        
        oxpCarousel.addEventListener('slide.bs.carousel', event => {
            oxpSlideMove = 1;
            _oxpSetActiveThumb( event.to );
        });
        oxpCarousel.addEventListener('slid.bs.carousel', event => {
            oxpSlideMove = 0;
        });

        oxpCarousel = new bootstrap.Carousel(oxpCarousel, {wrap: false});
        oxpThumbsCarousel = new bootstrap.Carousel(oxpThumbsCarousel, {wrap: false});

        oxpMaxPage = Math.trunc((window.GALLERY_DATA.length-1) / oxpPageSize);

        _oxpLoadThumbsPage(0);
        if (oxpMaxPage) _oxpLoadThumbsPage(1);

        let html = '';
        for ( let i = 0; i < oxpPageSize; i++ ) {
            html += `<div class="carousel-item"><a target="_blank"href=""><img src=""/></a></div>`;
        }
        $push( oxpInner, html );

        _oxpSetPageSlides(0);

        $on( '#gallery-oxp-items button', 'click', el => _oxpSlideBtn(el) );

        $addClass('#page-gallery .carousel-item:nth-child(1)', 'active');

        _oxpSetActiveThumb(0);
        _oxpSetActiveSlide(0);
    };

    const _init = (config) => {
        shuffleArray( window.GALLERY_DATA, Math.floor( Date.now() / 86400000 ) );
        _initBasic(config);
        _initOxp(config);

        $on('#gallery-buttons .btn-basic', 'click', el => _activateSet(el, 'basic') );
        $on('#gallery-buttons .btn-oxp',   'click', el => _activateSet(el, 'oxp') );
    };

    return ({
        init: _init,
    });
})();

const oxpManager = (()=>{
    let oxpData, oxpTable, descHidden = true, notVisible, visible = 20,
    curSort = '', curDir = 1;

    const _fetchData = () => {
        fetch('https://addons.oolite.space/data/oxp.json')
            .then( response => response.json() )
            .then( data => {
                oxpData = data;
                _sort('d', true);
                _drawLastOxpNews();
                _drawTbl();
                _linkSortCtrls();
            } );
    };

    const _showAllDesc = () => {
        if ( ! descHidden ) return false;
        descHidden = false;
        $addClass( $qq('tbody.oxp-tr-gr', oxpTable), 'desc' );
        return false;
    };

    const _showMore = (el,ev) => {
        if ( ! notVisible ) return;
        let cnt = el.dataset.cnt;
        if ( cnt === 'ALL' ) {
            $rmClass($qq('tbody.oxp-tr-gr', oxpTable), 'd-none');
            notVisible = 0;
        }
        else {
            cnt = +cnt;
            el = $q('tbody.oxp-tr-gr.d-none');
            if ( ! el ) return (notVisible = false);
            notVisible--;
            let els = [el];
            for ( let i = 0; i < cnt-1; i++ ) {
                el = el.nextElementSibling;
                if ( ! el ) break;
                notVisible--;
                els.push(el);
            }
            $rmClass(els, 'd-none');
        }
        visible = oxpData.length - notVisible;
        if ( ! notVisible ) $addClass('#show-more-oxp', 'd-none');
    };

    const _drawTbl = () => {
        const tplHtml = $q('#oxp-tbl-tr-tpl').innerHTML;
        mustache.parse(tplHtml);

        let html = '';
        notVisible = oxpData.length;
        for ( let i = 0; i < oxpData.length; i++ ) {
            let d = oxpData[i];
            let cls = i < 5 ? ' desc'
                : i < visible ? ''
                : ' d-none';

            const title = d.information_url
                ? `<a href="${d.information_url}">${d.title}</a>`
                : `<span class="oxp-title">${d.title}</span>`;
            html += mustache.render(tplHtml, {
                cls: cls,
                cat: d.category,
                title: title,
                ver: d.version,
                author: d.author,
                up: epochToYMD(d.upload_date),
                dload: d.download_url,
                desc: d.description
            });
        }
        notVisible -= visible;
        $push( oxpTable, html );
    };

    const _linkSortCtrls = () => {
        $on('.oxp-table thead a', 'click', el => _sort(el.dataset.sort) );
    };

    const _clearTbl = () => {
        let th = $q('thead', oxpTable).cloneNode(true);
        oxpTable.innerHTML = '';
        $push(oxpTable, th);
        _linkSortCtrls();
    };

    const _sort = (t = 'd', noDraw = false) => {
        let sfn, d1, d2;
        if ( t === 'd' ) {
            sfn = (a,b) => { return (b.upload_date - a.upload_date)*curDir };
        }
        else {
            let f = t === 'c' ? 'category'
                  : t === 't' ? 'title'
                  : t === 'a' ? 'author' : false;
            if (f)
                sfn = (a,b) => { if (a[f] > b[f]) return d1; if (a[f] < b[f]) return d2; };
        }
        if ( curSort === t ) curDir = -curDir;
        d1 = curDir, d2 = -curDir;
        curSort = t;
        if (sfn) oxpData.sort(sfn);
        if (noDraw) return;
        _clearTbl();
        _drawTbl();
    };

    const _drawLastOxpNews = () => {
        const tplHtml = $q('#oxp-news-item-tpl').innerHTML;
        mustache.parse(tplHtml);

        let html = '';
        for ( let i = 0; i < 5; i++ ) {
            const d = oxpData[i];
            html += mustache.render(tplHtml, {
                info: d.information_url,
                title: d.title,
                ver: d.version,
                up: epochToYMD(d.upload_date)
            });
        }
        if (html) $push( $q('#oxp-news-items'), html );
    };

    const _init = (config) => {
        oxpTable = $q('#page-oxp .oxp-table');
        $on('#show-all-oxp-desc', 'click', _showAllDesc );
        $on('a.show-more-oxp', 'click', _showMore );
        _fetchData();
    };

    return ({
        init: _init,
    });
})();

document.addEventListener( 'DOMContentLoaded', () => {

    fetchHTML( '#page-home-about', '/html/about.html', bindLinks );
    fetchHTML( '#news-items', '/html/news.html', processNews );
    fetchHTML( '#page-started .loadable-html', '/html/starting.html' );
    fetchHTML( '#page-download .loadable-html', '/html/download.html', setupDownloadVersions );

    titleManager.init(OONFIG);
    introBanner.init(OONFIG);
    versionNavigator.init(OONFIG);
    galleryManager.init(OONFIG);
    oxpManager.init(OONFIG);
    mainMenu.init(OONFIG);
} );

function bindLinks( container, html ) {

    if (html) $push( container, html );

    $on( $qq('a[href="#started"]',container),  'click', () => mainMenu.show('started',1)  );
    $on( $qq('a[href="#oxp"]',container),      'click', () => mainMenu.show('oxp',1)      );
    $on( $qq('a[href="#whatsnew"]',container), 'click', () => mainMenu.show('whatsnew',1) );
    $on( $qq('a[href="#download"]',container), 'click', () => mainMenu.show('download',1) );
}

function setupDownloadVersions( container, html ) {
    $push( container, html );
    let sv = OONFIG.stableVersion;
    $qq('a.oo-download', container).forEach( a => {
        a.setAttribute( 'href', sFormat( a.getAttribute('href'), sv.num ) );
    });
    $q('span.oo-stable-ver',  container).innerHTML = sv.num;
    $q('span.oo-stable-date', container).innerHTML = sv.date;

    bindLinks(container);
}

function processNews( container, html ) {
    $push( container, html );
    let nis = $qq('.news-item', container);
    for ( let i = 0; i < nis.length; i++ ) {
        if ( i < 3 ) continue;
        nis[i].remove();
    }
    $rmClass( container, 'd-none' );

    bindLinks(container);
}

