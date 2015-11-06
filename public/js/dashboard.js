var dashboard = angular.module("dashboard", ['ngRoute','smart-table','n3-line-chart']);

dashboard.config(['$routeProvider',
                  function($routeProvider) {
                    $routeProvider.
                    when('/showHome', {
                        templateUrl: 'showHome',
                        controller: 'HomeController'
                    }).
                      when('/showUsers', {
                        templateUrl: 'showUsers',
                        controller: 'userGridCtrl as ug'
                    }).
                      when('/showDevices', {
                        templateUrl: 'showDevices',
                        controller: 'deviceGridCtrl as dg'
                      }).
                      when('/showSessions', {
                          templateUrl: 'showSessions',
                          controller: 'sessionGridCtrl as sg'
                        }).
                      when('/showSessionsFrom/:from/:id', {
                            templateUrl: 'showSessions',
                            controller: 'sessionGridCtrl as sg'
                          }).
                      when('/viewSession/:id', {
                              templateUrl: 'viewSession'
                            }).
                      otherwise({
                        redirectTo: '/showHome'
                      });
                }]);