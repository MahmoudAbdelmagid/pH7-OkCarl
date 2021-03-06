<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Core / Class / Design
 */
namespace PH7;

class UserDesignCore extends Framework\Layout\Html\Design
{

    /**
     * Ajax counter of the number of users registered on the site.
     *
     * @return void
     */
    public function counterUsers()
    {
        $this->staticFiles('js', PH7_STATIC . PH7_JS, 'jquery/counter.js,Stat.js');
        echo '<div class="stat_total_users"></div>';
    }

}
