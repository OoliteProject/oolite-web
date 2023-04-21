'use strict';

window.OONFIG = {
  introBannerSlideCount: 51,
  versions: [
    [ '1.80', 'v1.80.html', '2014-07-01', 'archive' ],
    [ '1.82', 'v1.82.html', '2015-05-26', 'archive' ],
    [ '1.84', 'v1.84.html', '2016-07-21', 'archive' ],
    [ '1.86', 'v1.86.html', '2017-10-26', 'archive' ],
    [ '1.88', 'v1.88.html', '2018-10-27', 'archive' ],
    [ '1.90', 'v1.90.html', '2020-08-30', 'stable'  ],
    [ '1.91', 'v1.91.html', '2022-02-08', 'nightly' ]
  ]
};

for ( let i = 0; i < window.OONFIG.versions.length; i++ ) {
    if ( window.OONFIG.versions[i][3] === 'stable' ) {
        OONFIG.stableVersion = {
            num: OONFIG.versions[i][0],
            date: OONFIG.versions[i][2],
            index: i
        };
        break;
    }
}
