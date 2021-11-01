const lightCodeTheme = require('prism-react-renderer/themes/github');
const darkCodeTheme = require('prism-react-renderer/themes/dracula');

/** @type {import('@docusaurus/types').DocusaurusConfig} */
module.exports = {
  title: 'NextSMS PHP Client',
  tagline: 'NextSMS SDK for PHP applications',
  url: 'https://nextsms-php.netlify.app/',
  baseUrl: '/',
  onBrokenLinks: 'throw',
  onBrokenMarkdownLinks: 'warn',
  favicon: 'img/favicon.ico',
  organizationName: 'facebook', // Usually your GitHub org/user name.
  projectName: 'docusaurus', // Usually your repo name.
  themeConfig: {
    navbar: {
      title: 'NextSMS PHP Client',
      logo: {
        alt: 'NextSMS Logo',
        src: 'img/logo.svg',
      },
      items: [
        { href: 'https://nextsms.github.io/blog/', label: 'Blog', position: 'left' },
        {
            href: 'https://github.com/nextsms/php-client/',
            label: 'GitHub',
            position: 'right',
        },
    ],
    },
    footer: {
      style: 'dark',
      links: [
        {
          title: 'Docs',
          items: [
            {
              label: 'Tutorial',
              to: '/docs/intro',
            },
          ],
        },
        {
          title: 'Community',
          items: [
            {
              label: 'Stack Overflow',
              href: 'https://stackoverflow.com/questions/tagged/nextsms',
            },
          
            {
              label: 'Twitter',
              href: 'https://twitter.com/alphaolomi',
            },
          ],
        },
        {
          title: 'More',
          items: [
            {
              label: 'Blog',
              to: 'https://nextsms.github.io/blog',
            },
            {
              label: 'GitHub',
              href: 'https://github.com/nextsms/php-client',
            },
          ],
        },
      ],
      copyright: `Copyright © ${new Date().getFullYear()} NextSMS Community. Built with Docusaurus.`,
    },
    prism: {
      theme: lightCodeTheme,
      darkTheme: darkCodeTheme,
    },
  },
  presets: [
    [
      '@docusaurus/preset-classic',
      {
        docs: {
          sidebarPath: require.resolve('./sidebars.js'),
          // Please change this to your repo.
          editUrl:
            'https://github.com/nextsms/php-client/edit/main/docs/',
        },
        blog: false,
        theme: {
          customCss: require.resolve('./src/css/custom.css'),
        },
      },
    ],
  ],
};
