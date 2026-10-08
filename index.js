// file:        site/plugins/heineref_twoPanelLinks/index.js
// last update: 2026-10-08 by HeinerEF - some updates
// update:      2024-06-08 by HeinerEF - add class="k-help" for the 2 help-texts, since K4
//              2021-09-27 by HeinerEF - new fieldname: "help" => "help"
//              2020-04-23 by HeinerEF - https://forum.getkirby.com/u/HeinerEF

panel.plugin('HeinerEF/twoPanelLinks', {
  sections: {
    panelhomepage: {
      data: function () {
        return {
          headline: null,
          help: null,
          homepage: null,
        }
      },
      created: function() {
        this.load().then(response => {
          this.headline = response.headline;
          this.help = response.help;
          this.homepage = response.homepage;
        });
      },
      template: `
        <section class="k-twoPanelLinks-section k-section">
          <header class="k-section-header">
            <h2 class="k-headline">{{ headline }}</h2>
          </header>
          <div class="twoPanelLinks">
            <a v-for="page in homepage" :href="page.link" target="_blank"><span aria-hidden="true" data-back="pattern" class="k-icon k-icon-home"><svg viewBox="0 0 16 16" style="color: rgb(197, 201, 198);"><use xlink:href="#icon-home"></use></svg></span><span>{{ page.name }}</span></a>
          </div>
          <div data-theme="help" class="k-help k-collection-help k-text">{{ help }}</div>
        </section>
      `
    },
    paneluser: {

      data: function () {
        return {
          headline: null,
          help: null,
          latestUser: null,
        }
      },
      created: function() {
        this.load().then(response => {
          this.headline = response.headline;
          this.help = response.help;
          this.latestUser = response.latestUser;
        });
      },
      template: `
        <section class="k-twoPanelLinks-section k-section">
          <header class="k-section-header">
            <h2 class="k-headline">{{ headline }}</h2>
          </header>
          <div class="twoPanelLinks">
            <a v-for="user in latestUser" :href="user.link"><span aria-hidden="true" data-back="pattern" class="k-icon k-icon-user"><svg viewBox="0 0 16 16" style="color: rgb(197, 201, 198);"><use xlink:href="#icon-user"></use></svg></span><span>{{ user.name }}</span><div class="k-role">{{ user.role }}</div></a>
          </div>
          <div data-theme="help" class="k-help k-collection-help k-text">{{ help }}</div>
        </section>
      `
    }
  }
});

