const Obj = { };

(function(){
Obj.apply = function( dst, src, defaults ) {
    if (defaults) {
        Obj.apply( dst, defaults );
    }
    if ( src && 'object' === typeof src && dst ) {
        for ( let prop in src ) {
            dst[prop] = src[prop];
        }
    }
    return dst;
};

Obj.apply( Function.prototype, {
    createCallback: function(/* some args... */) {
        let args = arguments, meth = this;
        return function() {
            return meth.apply( window, args );
        };
    },
    createDelegate: function( scope, args, append_args ) {
        let meth = this;
        return function() {
            let call_args = args || arguments;
            if ( append_args === true ) {
                call_args = Array.prototype.slice.call( arguments, 0 );
                call_args = call_args.concat(args);
            }
            else if ( ! isNaN(parseInt(append_args)) ) {
                // copy arguments first
                call_args = Array.prototype.slice.call( arguments, 0 );
                // create method call params
                let apply_args = [ append_args, 0 ].concat(args);
                // splice them in
                Array.prototype.splice.apply( call_args, apply_args );
            }
            return meth.apply( scope || window, call_args );
        };
    }
} );
})();

const sFormat = ( s, ...args ) => {
    for ( let i = 0; i < args.length; i++ ) {
        let reg = new RegExp( '\\{' + i + '\\}', 'gm' );
        s = s.replace( reg, args[i] );
    }
    return s;
};

const $q = ( sel, parent = document ) => {
    return typeof sel === 'string' ? parent.querySelector(sel) : sel || null;
};

const $qq = ( sel, parent = document ) => {
    return typeof sel === "string"
        ? [].slice.call( parent.querySelectorAll(sel) )
        : Array.isArray(sel) ? sel : [sel];
};

const $on = ( sel, eventName, cb, opts, data ) => {
    let _opts = opts === false || opts
        ? opts
        : { prevent: true, capture: true };

    const _cb = ( event, cbData ) => {
        if ( cbData['prevent'] ) event.preventDefault();
        cbData['event'] = event;
        cb.call( window, event.target, cbData );
    };

    return $_bulk( sel, (el,i) => {
        let _cbData = Obj.apply({
            index: i,
            data: Obj.apply({},data)
        }, _opts);
        el.addEventListener( eventName, _cb.createDelegate( null, _cbData, true ), _opts );
    } );
};

const $_bulk = ( sel, cb ) => {
    let els = $qq(sel);
    for ( let i = 0; i < els.length; i++ ) cb( els[i], i );
    return els;
};

const $attr = ( sel, name, ...val ) => {
    if ( val.length === 0 ) return $q(sel).getAttribute(name);
    return $_bulk( sel, el => el.setAttribute( name, val[0] ) );
};

const $hasClass = ( sel, name ) => {
    let el = $q(sel);
    return el ? el.classList.contains(name) : false;
};

const $setClass = ( sel, names ) => {
    const cn = names.trim();
    return $_bulk( sel, el => el.className = cn );
};

const $addClass = ( sel, names ) => {
    return $_opClass( sel, names, (el,cn) => el.classList.add(cn) );
};

const $rmClass = ( sel, names ) => {
    return $_opClass( sel, names, (el,cn) => el.classList.remove(cn) );
};

const $tglClass = ( sel, names ) => {
    return $_opClass( sel, names, (el,cn) => el.classList.toggle(cn) );
};

const $_opClass = ( sel, names, cb ) => {
    let ns = names.trim().split(/\s+/);
    return $_bulk( sel, el => {
        for ( let k = 0; k < ns.length; k++ ) cb( el, ns[k] );
    } );
};

const $html = ( sel, html ) => {
    return $_bulk( sel, el => el.innerHTML = html );
};

const $unshift = ( sel, content ) => {
    if ( typeof content === 'string' )
        return $_bulk( sel, el => el.insertAdjacentHTML('afterbegin', content) );
    else
        return $_bulk( sel, el => {
            if ( el.firstChild )
                el.insertBefore(content, el.firstChild);
            else 
                el.appendChild(content);
        } );
};

const $push = ( sel, content ) => {
    if ( typeof content === 'string' )
        return $_bulk( sel, el => el.insertAdjacentHTML('beforeend', content) );
    else
        return $_bulk( sel, el => el.appendChild(content) );
};

const htmlToElement = (html) => {
    const template = document.createElement('template');
    template.innerHTML = html.trim();
    return template.content.firstChild;
};

const fetchHTML = ( sel, url, cb, mode ) => {
    fetch(url)
        .then( response => response.text() )
        .then( html => {
            let el = $q(sel);
            if (cb)
                cb.call( window, el, html );
            else if (el)
                el.insertAdjacentHTML( mode || 'beforeend', html );
        } );
};

const shuffleArray = (arr) => {
    for ( let i = arr.length - 1; i > 0; i-- ) {
        let j = Math.floor(Math.random() * (i + 1));
        [ arr[i], arr[j] ] = [ arr[j], arr[i] ];
    }
};

const simpleTpl = ( template, args ) => {
    return template.replace(/\{\{\s*(\w+)\s*\}\}/g, (m,n) => args[n] === undefined ? m : args[n] );
};

const epochToYMD = (epoch) => {
    let dt = new Date(0);
    dt.setUTCSeconds(epoch);
    let m=1+dt.getMonth();m=m<10?'0'+m:m;
    let d=dt.getDate();d=d<10?'0'+d:d;
    return `${dt.getFullYear()}-${m}-${d}`;
};

const scrollTop = ( to, duration = 200, callback ) => {
    const startingY = window.pageYOffset;
    const diff = to - startingY;
    let start;

    window.requestAnimationFrame(function step(timestamp) {
        if ( ! start) start = timestamp;

        const time = timestamp - start;

        const percent = Math.min(time / duration, 1);

        window.scrollTo(0, startingY + diff * percent);

        if ( time < duration ) {
            window.requestAnimationFrame(step);
        }
        else if ( typeof callback === 'function' ) {
            callback();
        }
    });
};
