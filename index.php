<?php
      // file:        site/plugins/heineref_twoPanelLinks/index.php
      // last update: 2026-10-08 by HeinerEF - some updates and extensions at 'props'
      //              2021-09-27 by HeinerEF - English translation of help for panelhomepage added
      //              2021-08-15 by HeinerEF - German translation of headline for panelhomepage fixed
      //              2020-09-29 by HeinerEF - paneluser: str_replace ('*', ' ', ...
      //              2020-05-02 by HeinerEF - German translation of headline for panelhomepage added
      //              2020-04-23 by HeinerEF - https://forum.getkirby.com/t/howto-build-panel-links-your-sites-url-and-your-account/17988

Kirby::plugin(
  name: 'heineref/twoPanelLinks',
  extends: [
    'sections' => [
      'panelhomepage' => [
        'props' => [
          'headline' => function($headline = "") {
            $userlang = kirby()->user()->language();
            if ($headline == "") {
              if ($userlang == "de") {
                $headline = "Startseite";
              } else {
                $headline = t("view.site");
              };
            } else {
              if (is_array($headline)) { // there are several translations
                $temp = "";
                if (array_key_exists($userlang, $headline)) {
                  [$userlang => $temp] = $headline;
                } else {
                  if (array_key_exists('en', $headline)) { // 'en' as default language
                    ['en' => $temp] = $headline;
                  } else {
                    $temp = array_shift($headline); // gets the first element of $headline
                  };
                };
                if ($temp) {
                  $headline = $temp;
                };
              };
            };
            return  $headline;
          },
          'help' => function($help = "") {
            $userlang = kirby()->user()->language();
            if ($help == "") { // to avoid the help: delete the whole "if ... };" statement
              if ($userlang == "de") {
                $help = "Link zur Startseite (öffnet in neuem Fenster)";
              } else {
                $help = "Link to home page (opens in new window)";
              };
            } else {
              if (is_array($help)) { // there are several translations
                $temp = "";
                if (array_key_exists($userlang, $help)) {
                  [$userlang => $temp] = $help;
                } else {
                  if (array_key_exists('en', $help)) { // 'en' as default language
                    ['en' => $temp] = $help;
                  } else {
                    $temp = array_shift($help); // gets the first element of $help
                  };
                };
                if ($temp) {
                  $help = $temp;
                };
              };
            };
            return $help;
          },
        ],
        'computed' => [
          'homepage' => function() {
            $homepage = array();
            $homepage['page'] = [
              'link' => url('/'),
              'name' => site()->title()->value(),
            ];
            return $homepage;
          },
        ],
      ],
      'paneluser' => [
        'props' => [
          'headline' => function($headline = "") {
            $userlang = kirby()->user()->language();
            if ($headline == "") {
              $headline = t("view.account");
            } else {
              if (is_array($headline)) { // there are several translations
                $temp = "";
                if (array_key_exists($userlang, $headline)) {
                  [$userlang => $temp] = $headline;
                } else {
                  if (array_key_exists('en', $headline)) { // 'en' as default language
                    ['en' => $temp] = $headline;
                  } else {
                    $temp = array_shift($headline); // gets the first element of $headline
                  };
                };
                if ($temp) {
                  $headline = $temp;
                };
              };
            };
            return $headline;
          },
          'help' => function($help = "") {
            $userlang = kirby()->user()->language();
            if ($help == "") { // to avoid the role-description: delete the whole "if ... };" statement
              $help = Str::excerpt( str_replace ('*', ' ', kirby()->user()->role()->description()), 1000);
            } else {
              if (is_array($help)) { // there are several translations
                $temp = "";
                if (array_key_exists($userlang, $help)) {
                  [$userlang => $temp] = $help;
                } else {
                  if (array_key_exists('en', $help)) { // 'en' as default language
                    ['en' => $temp] = $help;
                  } else {
                    $temp = array_shift($help); // gets the first element of $help
                  };
                };
                if ($temp) {
                  $help = $temp;
                };
              };
            };
            return $help;
          },
        ],
        'computed' => [
          'latestUser' => function() {
            $latestUser = array();
            $name = kirby()->user()->name()->value();
            if ($name == '') $name = t("link");
            $latestUser['user'] = [
              'link' => 'account',
              'name' => $name,
              'role' => kirbytextinline(kirby()->user()->role()->title()),
            ];
            return $latestUser;
          },
        ],
      ]
    ]
  ]
);

