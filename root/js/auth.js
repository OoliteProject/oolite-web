const auth = (()=>{
    let sid;

    const _init = (config) => {
    };

    const _status = () => {
    };

    const _signin = () => {
        const login = $q('#signin-login').value;
        const pass  = $q('#signin-pass').value;
        console.log(`signin call @${login}`);
    };

    const _signout = () => {
    };

    return ({
        init: _init,
        status: _status,
        signin: _signin,
        signout: _signout
    });
})();
