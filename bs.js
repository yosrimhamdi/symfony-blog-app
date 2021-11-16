const bs = require('browser-sync');

bs({
  proxy: '127.0.0.1:8000',
  notify: false,
  files: ['src/**', 'templates/**'],
});
