<?php
/**
 * Brand SVG Please
 *
 * @version 1.0.1
 * @link https://github.com/nk-o/brand-svg-please
 * @package bsp
 */

if ( ! class_exists( 'Brand_SVG_Please' ) ) :
    /**
     * Brand_SVG_Please Class
     */
    class Brand_SVG_Please {
        /**
         * Get the SVG string for a given icon.
         *
         * @param String $name - brand name.
         * @param Array  $data - svg icon data.
         *
         * @return String
         */
        public static function get( $name, $data = array() ) {
            $brand = self::find_brand( $name );

            if ( $brand ) {
                return self::get_svg_by_path( $brand['svg_path'], $data );
            }

            return null;
        }

        /**
         * Print the SVG string for a given icon.
         *
         * @param String $name - icon name.
         * @param Array  $data - svg icon data.
         */
        public static function get_e( $name, $data = array() ) {
            if ( self::exists( $name ) ) {
                echo wp_kses( self::get( $name, $data ), self::kses() );
            }
        }

        /**
         * Get the SVG string for a given icon.
         *
         * @param String $name - brand name.
         *
         * @return String
         */
        public static function get_name( $name ) {
            $brand = self::find_brand( $name );

            if ( $brand ) {
                return $brand['name'];
            }

            return null;
        }

        /**
         * Check if SVG icon exists.
         *
         * @param String $name - brand name.
         *
         * @return Boolean
         */
        public static function exists( $name ) {
            return ! ! self::find_brand( $name );
        }

        /**
         * Data for SVG useful in wp_kses function.
         *
         * @return Array
         */
        public static function kses() {
            return array(
                'svg'   => array(
                    'class'           => true,
                    'aria-hidden'     => true,
                    'aria-labelledby' => true,
                    'role'            => true,
                    'focusable'       => true,
                    'xmlns'           => true,
                    'width'           => true,
                    'height'          => true,
                    'viewbox'         => true,
                ),
                'g'     => array(
                    'fill' => true,
                ),
                'title' => array(
                    'title' => true,
                ),
                'path'  => array(
                    'd'    => true,
                    'fill' => true,
                ),
            );
        }

        /**
         * Find brand data.
         *
         * @param String $name - brand name.
         *
         * @return Null|Array
         */
        private static function find_brand( $name ) {
            $result = null;
            $brands = self::get_all_brands();

            // Find by key.
            if ( isset( $brands[ $name ] ) ) {
                $result = $brands[ $name ];
            }

            // Find by alternative keys.
            if ( ! $result ) {
                foreach ( $brands as $brand ) {
                    if ( ! $result && isset( $brand['keys'] ) && in_array( $name, $brand['keys'], true ) ) {
                        $result = $brand;
                    }
                }
            }

            return $result;
        }

        /**
         * Get the SVG string for a given icon.
         *
         * @param String $path - icon path.
         * @param Array  $data - svg icon data.
         *
         * @return String
         */
        private static function get_svg_by_path( $path, $data = array() ) {
            $data = array_merge(
                array(
                    'size'  => 24,
                    'class' => 'bsp-icon',
                ),
                $data
            );

            if ( file_exists( $path ) ) {
                // We can't use file_get_contents in WordPress themes.
                ob_start();
                include $path;
                $svg = ob_get_clean();

                // Add extra attributes to SVG code.
                // translators: %1$s - classname.
                // translators: %2$d - size.
                $repl = sprintf( '<svg class="%1$s" width="%2$d" height="%2$d" aria-hidden="true" role="img" focusable="false" ', $data['class'], $data['size'] );
                $svg  = preg_replace( '/^<svg /', $repl, trim( $svg ) );

                return $svg;
            }

            return null;
        }

        /**
         * Get all available brands.
         *
         * @param Boolean $get_svg - get SVG and insert it inside array.
         * @param Array   $svg_data - svg data.
         *
         * @return Array
         */
        public static function get_all_brands( $get_svg = false, $svg_data = array() ) {
            $brands = array(
                '500px'                     => esc_html__( '500px', 'bsp' ),
                'accusoft'                  => esc_html__( 'Accusoft', 'bsp' ),
                'acquisitions-incorporated' => esc_html__( 'Acquisitions Incorporated', 'bsp' ),
                'adn'                       => esc_html__( 'ADN', 'bsp' ),
                'adobe'                     => esc_html__( 'Adobe', 'bsp' ),
                'adversal'                  => esc_html__( 'Adversal', 'bsp' ),
                'airbnb'                    => esc_html__( 'Airbnb', 'bsp' ),
                'algolia'                   => esc_html__( 'Algolia', 'bsp' ),
                'alipay'                    => esc_html__( 'Alipay', 'bsp' ),
                'amazon-pay'                => esc_html__( 'Amazon Pay', 'bsp' ),
                'amazon'                    => esc_html__( 'Amazon', 'bsp' ),
                'amilia'                    => esc_html__( 'Amilia', 'bsp' ),
                'android'                   => esc_html__( 'Android', 'bsp' ),
                'angellist'                 => esc_html__( 'AngelList', 'bsp' ),
                'angrycreative'             => esc_html__( 'Angry Creative', 'bsp' ),
                'angular'                   => esc_html__( 'Angular', 'bsp' ),
                'app-store'                 => esc_html__( 'App Store', 'bsp' ),
                'apper'                     => esc_html__( 'Apper', 'bsp' ),
                'apple-pay'                 => esc_html__( 'Apple Pay', 'bsp' ),
                'apple'                     => esc_html__( 'Apple', 'bsp' ),
                'artstation'                => esc_html__( 'ArtStation', 'bsp' ),
                'asymmetrik'                => esc_html__( 'Asymmetrik', 'bsp' ),
                'atlassian'                 => esc_html__( 'Atlassian', 'bsp' ),
                'audible'                   => esc_html__( 'Audible', 'bsp' ),
                'autoprefixer'              => esc_html__( 'Autoprefixer', 'bsp' ),
                'avianex'                   => esc_html__( 'Avianex', 'bsp' ),
                'aviato'                    => esc_html__( 'Aviato', 'bsp' ),
                'bandcamp'                  => esc_html__( 'Bandcamp', 'bsp' ),
                'battle-net'                => esc_html__( 'Battle.net', 'bsp' ),
                'behance'                   => esc_html__( 'Behance', 'bsp' ),
                'bimobject'                 => esc_html__( 'BIMobject', 'bsp' ),
                'bitbucket'                 => esc_html__( 'Bitbucket', 'bsp' ),
                'bitcoin'                   => esc_html__( 'Bitcoin', 'bsp' ),
                'bity'                      => esc_html__( 'Bity', 'bsp' ),
                'black-tie'                 => esc_html__( 'Black Tie', 'bsp' ),
                'blackberry'                => esc_html__( 'BlackBerry', 'bsp' ),
                'blogger'                   => esc_html__( 'Blogger', 'bsp' ),
                'bluetooth'                 => esc_html__( 'Bluetooth', 'bsp' ),
                'bootstrap'                 => esc_html__( 'Bootstrap', 'bsp' ),
                'btc'                       => esc_html__( 'BTC', 'bsp' ),
                'buffer'                    => esc_html__( 'Buffer', 'bsp' ),
                'buromobelexperte'          => esc_html__( 'Büromöbel Experte', 'bsp' ),
                'buy-n-large'               => esc_html__( 'Buy n Large', 'bsp' ),
                'buysellads'                => esc_html__( 'BuySellAds', 'bsp' ),
                'canadian-maple-leaf'       => esc_html__( 'Canadian Gold Maple Leaf', 'bsp' ),
                'cc-amazon-pay'             => esc_html__( 'Amazon Pay', 'bsp' ),
                'cc-amex'                   => esc_html__( 'Amex', 'bsp' ),
                'cc-apple-pay'              => esc_html__( 'Apple Pay', 'bsp' ),
                'cc-diners-club'            => esc_html__( 'Diners Club', 'bsp' ),
                'cc-discover'               => esc_html__( 'Discover', 'bsp' ),
                'cc-jcb'                    => esc_html__( 'JCB', 'bsp' ),
                'cc-mastercard'             => esc_html__( 'Mastercard', 'bsp' ),
                'cc-paypal'                 => esc_html__( 'PayPal', 'bsp' ),
                'cc-stripe'                 => esc_html__( 'Stripe', 'bsp' ),
                'cc-visa'                   => esc_html__( 'Visa', 'bsp' ),
                'centercode'                => esc_html__( 'Centercode', 'bsp' ),
                'centos'                    => esc_html__( 'CentOS', 'bsp' ),
                'chrome'                    => esc_html__( 'Chrome', 'bsp' ),
                'chromecast'                => esc_html__( 'Chromecast', 'bsp' ),
                'cloudscale'                => esc_html__( 'CloudScale', 'bsp' ),
                'cloudsmith'                => esc_html__( 'Cloudsmith', 'bsp' ),
                'cloudversify'              => esc_html__( 'Cloudversify', 'bsp' ),
                'codepen'                   => esc_html__( 'CodePen', 'bsp' ),
                'codiepie'                  => esc_html__( 'CodiePie', 'bsp' ),
                'confluence'                => esc_html__( 'Confluence', 'bsp' ),
                'connectdevelop'            => esc_html__( 'Connect Develop', 'bsp' ),
                'contao'                    => esc_html__( 'Contao', 'bsp' ),
                'cotton-bureau'             => esc_html__( 'Cotton Bureau', 'bsp' ),
                'cpanel'                    => esc_html__( 'cPanel', 'bsp' ),
                'critical-role'             => esc_html__( 'Critical Role', 'bsp' ),
                'css3'                      => esc_html__( 'CSS3', 'bsp' ),
                'cuttlefish'                => esc_html__( 'Cuttlefish', 'bsp' ),
                'd-and-d-beyond'            => esc_html__( 'D&D Beyond', 'bsp' ),
                'd-and-d'                   => esc_html__( 'D&D', 'bsp' ),
                'dailymotion'               => esc_html__( 'Dailymotion', 'bsp' ),
                'dashcube'                  => esc_html__( 'Dashcube', 'bsp' ),
                'delicious'                 => esc_html__( 'Delicious', 'bsp' ),
                'deploydog'                 => array(
                    'name' => esc_html__( 'deploy.dog', 'bsp' ),
                    'kays' => array( 'dd' ),
                ),
                'deskpro'                   => esc_html__( 'Deskpro', 'bsp' ),
                'dev'                       => esc_html__( 'Dev', 'bsp' ),
                'deviantart'                => esc_html__( 'DeviantArt', 'bsp' ),
                'dhl'                       => esc_html__( 'DHL', 'bsp' ),
                'diaspora'                  => esc_html__( 'Diaspora', 'bsp' ),
                'digg'                      => esc_html__( 'Digg', 'bsp' ),
                'digital-ocean'             => esc_html__( 'Digital Ocean', 'bsp' ),
                'discord'                   => esc_html__( 'Discord', 'bsp' ),
                'discourse'                 => esc_html__( 'Discourse', 'bsp' ),
                'dochub'                    => esc_html__( 'DocHub', 'bsp' ),
                'docker'                    => esc_html__( 'Docker', 'bsp' ),
                'draft2digital'             => esc_html__( 'Draft2Digital', 'bsp' ),
                'dribbble'                  => esc_html__( 'Dribbble', 'bsp' ),
                'dropbox'                   => esc_html__( 'Dropbox', 'bsp' ),
                'drupal'                    => esc_html__( 'Drupal', 'bsp' ),
                'dyalog'                    => esc_html__( 'Dyalog', 'bsp' ),
                'earlybirds'                => esc_html__( 'Earlybirds', 'bsp' ),
                'ebay'                      => esc_html__( 'eBay', 'bsp' ),
                'edge'                      => esc_html__( 'Edge', 'bsp' ),
                'elementor'                 => esc_html__( 'Elementor', 'bsp' ),
                'ello'                      => esc_html__( 'Ello', 'bsp' ),
                'ember'                     => esc_html__( 'Ember', 'bsp' ),
                'empire'                    => esc_html__( 'Empire', 'bsp' ),
                'envira'                    => esc_html__( 'Envira', 'bsp' ),
                'erlang'                    => esc_html__( 'Erlang', 'bsp' ),
                'ethereum'                  => esc_html__( 'Ethereum', 'bsp' ),
                'etsy'                      => esc_html__( 'Etsy', 'bsp' ),
                'evernote'                  => esc_html__( 'Evernote', 'bsp' ),
                'expeditedssl'              => esc_html__( 'ExpeditedSSL', 'bsp' ),
                'facebook-messenger'        => esc_html__( 'Facebook Messenger', 'bsp' ),
                'facebook'                  => esc_html__( 'Facebook', 'bsp' ),
                'fantasy-flight-games'      => esc_html__( 'Fantasy Flight Games', 'bsp' ),
                'fedex'                     => esc_html__( 'FedEx', 'bsp' ),
                'fedora'                    => esc_html__( 'Fedora', 'bsp' ),
                'figma'                     => esc_html__( 'Figma', 'bsp' ),
                'firefox-browser'           => esc_html__( 'Firefox Browser', 'bsp' ),
                'firefox'                   => esc_html__( 'Firefox', 'bsp' ),
                'first-order'               => esc_html__( 'First Order', 'bsp' ),
                'firstdraft'                => esc_html__( 'Firstdraft', 'bsp' ),
                'flickr'                    => esc_html__( 'Flickr', 'bsp' ),
                'flipboard'                 => esc_html__( 'Flipboard', 'bsp' ),
                'fly'                       => esc_html__( 'Fly', 'bsp' ),
                'font-awesome'              => esc_html__( 'Font Awesome', 'bsp' ),
                'fonticons'                 => esc_html__( 'Fonticons', 'bsp' ),
                'fort-awesome'              => esc_html__( 'Fort Awesome', 'bsp' ),
                'forumbee'                  => esc_html__( 'Forumbee', 'bsp' ),
                'foursquare'                => esc_html__( 'Foursquare', 'bsp' ),
                'free-code-camp'            => esc_html__( 'freeCodeCamp', 'bsp' ),
                'freebsd'                   => esc_html__( 'FreeBSD', 'bsp' ),
                'fulcrum'                   => esc_html__( 'Fulcrum', 'bsp' ),
                'galactic-republic'         => esc_html__( 'Galactic Republic', 'bsp' ),
                'galactic-senate'           => esc_html__( 'Galactic Senate', 'bsp' ),
                'get-pocket'                => array(
                    'name' => esc_html__( 'Pocket', 'bsp' ),
                    'keys' => array( 'pocket' ),
                ),
                'gg'                        => esc_html__( 'GG', 'bsp' ),
                'git'                       => esc_html__( 'Git', 'bsp' ),
                'github'                    => esc_html__( 'GitHub', 'bsp' ),
                'gitkraken'                 => esc_html__( 'GitKraken', 'bsp' ),
                'gitlab'                    => esc_html__( 'GitLab', 'bsp' ),
                'gitter'                    => esc_html__( 'Gitter', 'bsp' ),
                'glide'                     => esc_html__( 'Glide', 'bsp' ),
                'gofore'                    => esc_html__( 'Gofore', 'bsp' ),
                'goodreads'                 => esc_html__( 'Goodreads', 'bsp' ),
                'google-drive'              => esc_html__( 'Google Drive', 'bsp' ),
                'google-play'               => esc_html__( 'Google Play', 'bsp' ),
                'google-plus'               => esc_html__( 'Google Plus', 'bsp' ),
                'google-wallet'             => esc_html__( 'Google Wallet', 'bsp' ),
                'google'                    => esc_html__( 'Google', 'bsp' ),
                'gratipay'                  => esc_html__( 'Gratipay', 'bsp' ),
                'grav'                      => esc_html__( 'Grav', 'bsp' ),
                'gripfire'                  => esc_html__( 'Gripfire', 'bsp' ),
                'grunt'                     => esc_html__( 'Grunt', 'bsp' ),
                'gulp'                      => esc_html__( 'Gulp', 'bsp' ),
                'hacker-news'               => esc_html__( 'Hacker News', 'bsp' ),
                'hackerrank'                => esc_html__( 'HackerRank', 'bsp' ),
                'hips'                      => esc_html__( 'HIPS', 'bsp' ),
                'hire-a-helper'             => esc_html__( 'HireAHelper', 'bsp' ),
                'hornbill'                  => esc_html__( 'Hornbill', 'bsp' ),
                'hotjar'                    => esc_html__( 'Hotjar', 'bsp' ),
                'houzz'                     => esc_html__( 'Houzz', 'bsp' ),
                'html5'                     => esc_html__( 'HTML5', 'bsp' ),
                'hubspot'                   => esc_html__( 'HubSpot', 'bsp' ),
                'ideal'                     => esc_html__( 'iDEAL', 'bsp' ),
                'imdb'                      => esc_html__( 'IMDb', 'bsp' ),
                'instagram'                 => esc_html__( 'Instagram', 'bsp' ),
                'intercom'                  => esc_html__( 'Intercom', 'bsp' ),
                'internet-explorer'         => array(
                    'name' => esc_html__( 'Internet Explorer', 'bsp' ),
                    'keys' => array( 'ie' ),
                ),
                'invision'                  => esc_html__( 'InVision', 'bsp' ),
                'ioxhost'                   => esc_html__( 'IoxHost', 'bsp' ),
                'itch-io'                   => esc_html__( 'itch.io', 'bsp' ),
                'itunes'                    => esc_html__( 'iTunes', 'bsp' ),
                'java'                      => esc_html__( 'Java', 'bsp' ),
                'jedi-order'                => esc_html__( 'Jedi Order', 'bsp' ),
                'jenkins'                   => esc_html__( 'Jenkins', 'bsp' ),
                'jira'                      => esc_html__( 'Jira', 'bsp' ),
                'joget'                     => esc_html__( 'Joget', 'bsp' ),
                'joomla'                    => esc_html__( 'Joomla', 'bsp' ),
                'js'                        => array(
                    'name' => esc_html__( 'JS', 'bsp' ),
                    'keys' => array( 'javascript' ),
                ),
                'jsfiddle'                  => esc_html__( 'JSFiddle', 'bsp' ),
                'kaggle'                    => esc_html__( 'Kaggle', 'bsp' ),
                'keybase'                   => esc_html__( 'Keybase', 'bsp' ),
                'keycdn'                    => esc_html__( 'KeyCDN', 'bsp' ),
                'kickstarter'               => esc_html__( 'Kickstarter', 'bsp' ),
                'korvue'                    => esc_html__( 'Korvue', 'bsp' ),
                'laravel'                   => esc_html__( 'Laravel', 'bsp' ),
                'lastfm'                    => esc_html__( 'Last.fm', 'bsp' ),
                'leanpub'                   => esc_html__( 'Leanpub', 'bsp' ),
                'less'                      => esc_html__( 'Less', 'bsp' ),
                'line'                      => esc_html__( 'Line', 'bsp' ),
                'linkedin'                  => esc_html__( 'LinkedIn', 'bsp' ),
                'linode'                    => esc_html__( 'Linode', 'bsp' ),
                'linux'                     => esc_html__( 'Linux', 'bsp' ),
                'lyft'                      => esc_html__( 'Lyft', 'bsp' ),
                'magento'                   => esc_html__( 'Magento', 'bsp' ),
                'mailchimp'                 => esc_html__( 'Mailchimp', 'bsp' ),
                'mandalorian'               => esc_html__( 'Mandalorian', 'bsp' ),
                'markdown'                  => array(
                    'name' => esc_html__( 'Markdown', 'bsp' ),
                    'keys' => array( 'md' ),
                ),
                'mastodon'                  => esc_html__( 'Mastodon', 'bsp' ),
                'maxcdn'                    => esc_html__( 'MaxCDN', 'bsp' ),
                'mdb'                       => esc_html__( 'MDB', 'bsp' ),
                'medapps'                   => esc_html__( 'MedApps', 'bsp' ),
                'medium'                    => esc_html__( 'Medium', 'bsp' ),
                'medrt'                     => esc_html__( 'Medrt', 'bsp' ),
                'meetup'                    => esc_html__( 'Meetup', 'bsp' ),
                'megaport'                  => esc_html__( 'Megaport', 'bsp' ),
                'mendeley'                  => esc_html__( 'Mendeley', 'bsp' ),
                'microblog'                 => esc_html__( 'Micro.blog', 'bsp' ),
                'microsoft'                 => esc_html__( 'Microsoft', 'bsp' ),
                'mix'                       => esc_html__( 'Mix', 'bsp' ),
                'mixcloud'                  => esc_html__( 'Mixcloud', 'bsp' ),
                'mixer'                     => esc_html__( 'Mixer', 'bsp' ),
                'mizuni'                    => esc_html__( 'Mizuni', 'bsp' ),
                'modx'                      => esc_html__( 'MODX', 'bsp' ),
                'monero'                    => esc_html__( 'Monero', 'bsp' ),
                'napster'                   => esc_html__( 'Mapster', 'bsp' ),
                'neos'                      => esc_html__( 'Neos', 'bsp' ),
                'nimblr'                    => esc_html__( 'Nimblr', 'bsp' ),
                'node-js'                   => esc_html__( 'Node.js', 'bsp' ),
                'node'                      => esc_html__( 'Node', 'bsp' ),
                'npm'                       => esc_html__( 'npm', 'bsp' ),
                'ns8'                       => esc_html__( 'NS8', 'bsp' ),
                'nutritionix'               => esc_html__( 'Nutritionix', 'bsp' ),
                'odnoklassniki'             => array(
                    'name' => esc_html__( 'Odnoklassniki', 'bsp' ),
                    'keys' => array( 'ok' ),
                ),
                'old-republic'              => esc_html__( 'Old Republic', 'bsp' ),
                'opencart'                  => esc_html__( 'OpenCart', 'bsp' ),
                'openid'                    => esc_html__( 'OpenID', 'bsp' ),
                'opera'                     => esc_html__( 'Opera', 'bsp' ),
                'optin-monster'             => esc_html__( 'OptinMonster', 'bsp' ),
                'orcid'                     => esc_html__( 'ORCID', 'bsp' ),
                'osi'                       => esc_html__( 'OSI', 'bsp' ),
                'page4'                     => esc_html__( 'PAGE4', 'bsp' ),
                'pagelines'                 => esc_html__( 'PageLines', 'bsp' ),
                'palfed'                    => esc_html__( 'PalFed', 'bsp' ),
                'patreon'                   => esc_html__( 'Patreon', 'bsp' ),
                'paypal'                    => esc_html__( 'PayPal', 'bsp' ),
                'penny-arcade'              => esc_html__( 'Penny Arcade', 'bsp' ),
                'periscope'                 => esc_html__( 'Periscope', 'bsp' ),
                'phabricator'               => esc_html__( 'Phabricator', 'bsp' ),
                'phoenix-framework'         => esc_html__( 'Phoenix Framework', 'bsp' ),
                'phoenix-squadron'          => esc_html__( 'Phoenix Squadron', 'bsp' ),
                'php'                       => esc_html__( 'PHP', 'bsp' ),
                'pinterest'                 => esc_html__( 'Pinterest', 'bsp' ),
                'playstation'               => array(
                    'name' => esc_html__( 'PlayStation', 'bsp' ),
                    'keys' => array( 'ps' ),
                ),
                'product-hunt'              => esc_html__( 'Product Hunt', 'bsp' ),
                'pushed'                    => esc_html__( 'Pushed', 'bsp' ),
                'python'                    => esc_html__( 'Python', 'bsp' ),
                'qq'                        => array(
                    'name' => esc_html__( 'Tencent QQ', 'bsp' ),
                    'keys' => array( 'tencent-qq' ),
                ),
                'quinscape'                 => esc_html__( 'QuinScape', 'bsp' ),
                'quora'                     => esc_html__( 'Quora', 'bsp' ),
                'r-project'                 => esc_html__( 'R', 'bsp' ),
                'raspberry-pi'              => esc_html__( 'Raspberry Pi', 'bsp' ),
                'ravelry'                   => esc_html__( 'Ravelry', 'bsp' ),
                'react'                     => esc_html__( 'React', 'bsp' ),
                'reacteurope'               => esc_html__( 'ReactEurope', 'bsp' ),
                'readme'                    => esc_html__( 'ReadMe', 'bsp' ),
                'rebel'                     => esc_html__( 'Rebel', 'bsp' ),
                'red-river'                 => esc_html__( 'Red River', 'bsp' ),
                'reddit'                    => esc_html__( 'reddit', 'bsp' ),
                'redhat'                    => esc_html__( 'Red Hat', 'bsp' ),
                'renren'                    => esc_html__( 'Renren', 'bsp' ),
                'replyd'                    => esc_html__( 'Replyd', 'bsp' ),
                'researchgate'              => esc_html__( 'ResearchGate', 'bsp' ),
                'resolving'                 => esc_html__( 'Resolving', 'bsp' ),
                'rev'                       => esc_html__( 'Rev', 'bsp' ),
                'rocketchat'                => esc_html__( 'Rocket.Chat', 'bsp' ),
                'rockrms'                   => esc_html__( 'Rock RMS', 'bsp' ),
                'safari'                    => esc_html__( 'Safari', 'bsp' ),
                'salesforce'                => esc_html__( 'Salesforce', 'bsp' ),
                'sass'                      => esc_html__( 'Sass', 'bsp' ),
                'schlix'                    => esc_html__( 'SCHLIX', 'bsp' ),
                'scribd'                    => esc_html__( 'Scribd', 'bsp' ),
                'searchengin'               => esc_html__( 'Searchengin', 'bsp' ),
                'sellcast'                  => esc_html__( 'SellCast', 'bsp' ),
                'sellsy'                    => esc_html__( 'Sellsy', 'bsp' ),
                'servicestack'              => esc_html__( 'ServiceStack', 'bsp' ),
                'shirtsinbulk'              => esc_html__( 'Shirts In Bulk', 'bsp' ),
                'shopify'                   => esc_html__( 'Shopify', 'bsp' ),
                'shopware'                  => esc_html__( 'Shopware', 'bsp' ),
                'simplybuilt'               => esc_html__( 'SimplyBuilt', 'bsp' ),
                'sistrix'                   => esc_html__( 'SISTRIX', 'bsp' ),
                'sith'                      => esc_html__( 'Sith', 'bsp' ),
                'sketch'                    => esc_html__( 'Sketch', 'bsp' ),
                'skyatlas'                  => esc_html__( 'SkyAtlas', 'bsp' ),
                'skype'                     => esc_html__( 'Skype', 'bsp' ),
                'slack'                     => esc_html__( 'Slack', 'bsp' ),
                'slideshare'                => esc_html__( 'SlideShare', 'bsp' ),
                'snapchat'                  => esc_html__( 'Snapchat', 'bsp' ),
                'soundcloud'                => esc_html__( 'SoundCloud', 'bsp' ),
                'sourcetree'                => esc_html__( 'Sourcetree', 'bsp' ),
                'speakap'                   => esc_html__( 'Speakap', 'bsp' ),
                'speaker-deck'              => esc_html__( 'Speaker Deck', 'bsp' ),
                'spotify'                   => esc_html__( 'Spotify', 'bsp' ),
                'squarespace'               => esc_html__( 'Squarespace', 'bsp' ),
                'stack-exchange'            => esc_html__( 'Stack Exchange', 'bsp' ),
                'stack-overflow'            => esc_html__( 'Stack Overflow', 'bsp' ),
                'stackpath'                 => esc_html__( 'StackPath', 'bsp' ),
                'staylinked'                => esc_html__( 'StayLinked', 'bsp' ),
                'steam'                     => esc_html__( 'Steam', 'bsp' ),
                'sticker-mule'              => esc_html__( 'Sticker Mule', 'bsp' ),
                'strava'                    => esc_html__( 'Strava', 'bsp' ),
                'stripe'                    => esc_html__( 'Stripe', 'bsp' ),
                'studiovinari'              => esc_html__( 'Studio Vinari', 'bsp' ),
                'stumbleupon'               => esc_html__( 'StumbleUpon', 'bsp' ),
                'superpowers'               => esc_html__( 'Superpowers', 'bsp' ),
                'supple'                    => esc_html__( 'Supple', 'bsp' ),
                'suse'                      => esc_html__( 'SuSE', 'bsp' ),
                'swift'                     => esc_html__( 'Swift', 'bsp' ),
                'symfony'                   => esc_html__( 'Symfony', 'bsp' ),
                'teamspeak'                 => esc_html__( 'SeamSpeak', 'bsp' ),
                'telegram'                  => esc_html__( 'Telegram', 'bsp' ),
                'tencent-weibo'             => esc_html__( 'Tencent Weibo', 'bsp' ),
                'the-red-yeti'              => esc_html__( 'The Red Yeti', 'bsp' ),
                'themeisle'                 => esc_html__( 'Themeisle', 'bsp' ),
                'think-peaks'               => esc_html__( 'ThinkPeaks', 'bsp' ),
                'tiktok'                    => esc_html__( 'TikTok', 'bsp' ),
                'trade-federation'          => esc_html__( 'Trade Federation', 'bsp' ),
                'trello'                    => esc_html__( 'Trello', 'bsp' ),
                'tripadvisor'               => esc_html__( 'Tripadvisor', 'bsp' ),
                'tumblr'                    => esc_html__( 'Tumblr', 'bsp' ),
                'twitch'                    => esc_html__( 'Twitch', 'bsp' ),
                'twitter'                   => esc_html__( 'Twitter', 'bsp' ),
                'typo3'                     => esc_html__( 'TYPO3', 'bsp' ),
                'uber'                      => esc_html__( 'Uber', 'bsp' ),
                'ubuntu'                    => esc_html__( 'Ubuntu', 'bsp' ),
                'uikit'                     => esc_html__( 'UIkit', 'bsp' ),
                'umbraco'                   => esc_html__( 'Umbraco', 'bsp' ),
                'uniregistry'               => esc_html__( 'Uniregistry', 'bsp' ),
                'unity'                     => esc_html__( 'Unity', 'bsp' ),
                'untappd'                   => esc_html__( 'Untappd', 'bsp' ),
                'ups'                       => esc_html__( 'UPS', 'bsp' ),
                'usps'                      => esc_html__( 'USPS', 'bsp' ),
                'ussunnah'                  => esc_html__( 'us-Sunnah', 'bsp' ),
                'vaadin'                    => esc_html__( 'Vaadin', 'bsp' ),
                'viacoin'                   => esc_html__( 'Viacoin', 'bsp' ),
                'viadeo'                    => esc_html__( 'Viadeo', 'bsp' ),
                'viber'                     => esc_html__( 'Viber', 'bsp' ),
                'vimeo'                     => esc_html__( 'Vimeo', 'bsp' ),
                'vine'                      => esc_html__( 'Vine', 'bsp' ),
                'vk'                        => array(
                    'name' => esc_html__( 'VK', 'bsp' ),
                    'keys' => array( 'vkontakte' ),
                ),
                'vnv'                       => esc_html__( 'VNV', 'bsp' ),
                'vuejs'                     => esc_html__( 'Vue.js', 'bsp' ),
                'waze'                      => esc_html__( 'Waze', 'bsp' ),
                'wechat'                    => array(
                    'name' => esc_html__( 'WeChat', 'bsp' ),
                    'keys' => array( 'weixin' ),
                ),
                'weebly'                    => esc_html__( 'Weebly', 'bsp' ),
                'weibo'                     => array(
                    'name' => esc_html__( 'Sina Weibo', 'bsp' ),
                    'keys' => array( 'sina-weibo' ),
                ),
                'weixin'                    => esc_html__( 'Weixin', 'bsp' ),
                'whatsapp'                  => esc_html__( 'WhatsApp', 'bsp' ),
                'whmcs'                     => esc_html__( 'WHMCS', 'bsp' ),
                'wikipedia'                 => esc_html__( 'Wikipedia', 'bsp' ),
                'windows'                   => esc_html__( 'Windows', 'bsp' ),
                'wix'                       => esc_html__( 'WIX', 'bsp' ),
                'wizards-of-the-coast'      => esc_html__( 'Wizards of the Coast', 'bsp' ),
                'wolf-pack-battalion'       => esc_html__( 'Wolf Pack Battalion', 'bsp' ),
                'wordpress'                 => esc_html__( 'WordPress', 'bsp' ),
                'wpbeginner'                => esc_html__( 'WPBeginner', 'bsp' ),
                'wpexplorer'                => esc_html__( 'WPExplorer', 'bsp' ),
                'wpforms'                   => esc_html__( 'WPForms', 'bsp' ),
                'wpressr'                   => esc_html__( 'WPressr', 'bsp' ),
                'xbox'                      => esc_html__( 'Xbox', 'bsp' ),
                'xing'                      => esc_html__( 'XING', 'bsp' ),
                'y-combinator'              => esc_html__( 'YCombinator', 'bsp' ),
                'yahoo'                     => esc_html__( 'Yahoo', 'bsp' ),
                'yammer'                    => esc_html__( 'Yammer', 'bsp' ),
                'yandex'                    => esc_html__( 'Yandex', 'bsp' ),
                'yarn'                      => esc_html__( 'Yarn', 'bsp' ),
                'yelp'                      => esc_html__( 'Yelp', 'bsp' ),
                'yoast'                     => esc_html__( 'Yoast', 'bsp' ),
                'youtube'                   => esc_html__( 'Youtube', 'bsp' ),
                'zhihu'                     => esc_html__( 'Zhihu', 'bsp' ),
            );

            $result    = array();
            $base_path = __DIR__ . '/svg/';

            // Prepare SVG paths.
            foreach ( $brands as $k => $data ) {
                $svg_path = $base_path . $k . '.svg';

                if ( file_exists( $svg_path ) ) {
                    $result[ $k ] = array_merge(
                        is_array( $data ) ? $data : array(
                            'name' => $data,
                        ),
                        $get_svg ? array(
                            'svg' => self::get_svg_by_path( $svg_path, $svg_data ),
                        ) : array(),
                        array(
                            'svg_path' => $base_path . $k . '.svg',
                        )
                    );
                }
            }

            return $result;
        }
    }
endif;
