const mix = require('laravel-mix');
  
// ======== Angular js =========
mix.js('node_modules/angular/angular.min.js', 'public/ng-app')
mix.js('node_modules/angular-route/angular-route.min.js', 'public/ng-app')
mix.js('resources/js/ng-app.js', 'public/ng-app');


// ========= Geneal  ===========
mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/css/app.scss', 'public/css');