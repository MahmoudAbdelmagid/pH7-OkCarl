<?php
/**
 * @author         Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright      (c) 2012-2013, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; See PH7.LICENSE.txt and PH7.COPYRIGHT.txt in the root directory.
 * @package        PH7 / App / System / Module / Affiliate / Controller
 */
namespace PH7;
use PH7\Framework\Mvc\Router\Uri;

class AccountController extends Controller
{
    private $sTitle;

    public function index()
    {
        $this->sTitle = t('Account - Affiliate');
        $this->view->page_title = $this->sTitle;
        $this->view->h1_title = $this->sTitle;

        $this->output();
    }

    public function edit()
    {
        // Adding Css Style for Tabs
        $this->design->addCss(PH7_LAYOUT . PH7_TPL . PH7_TPL_NAME . PH7_SH . PH7_CSS, 'tabs.css');

        $this->sTitle = t('Edit your profile');
        $this->view->page_title = $this->sTitle;
        $this->view->h2_title = $this->sTitle;
        $this->output();
    }

    public function password()
    {
        $this->sTitle = t('Change Password');
        $this->view->page_title = $this->sTitle;
        $this->view->h2_title = $this->sTitle;
        $this->output();
    }

    public function delete()
    {
        $this->sTitle = t('Delete Affiliate Account');
        $this->view->page_title = $this->sTitle;
        $this->view->h2_title = $this->sTitle;

        if ($this->httpRequest->get('delete_status') == 'yesdelete')
        {
            $this->session->set('yes_delete', 1);
            Framework\Url\HeaderUrl::redirect(Uri::get('affiliate', 'account', 'yesdelete'));
        }
        elseif ($this->httpRequest->get('delete_status') == 'nodelete')
        {
            $this->view->content = t('<span class="bold green1">Great, you stay with us!<br />
            You see, you will not regret it!<br />We will do our best to you our %site_name%!</span>');
            $this->design->setRedirect(Uri::get('affiliate', 'home', 'index'), null, null, 3);
        }
        else
        {
            $this->view->content = '<span class="bold red">' . t('WARNING: If you delete your account you will not receive your money.') .
                '<br />' . t('Are you really sure you want to delete your account?') . '</span><br /><br />
                <a class="bold" href="' . Uri::get('affiliate', 'account',
                'delete', 'nodelete') . '">' . t('No I changed my mind and I stay with you!') .
                '</a> &nbsp; ' . t('OR') . ' &nbsp; <a href="' . Uri::get('affiliate',
                'account', 'delete', 'yesdelete') . '">' . t('Yes I really want to delete my account') .
                '</a>';
        }

        $this->output();
    }

    public function yesDelete()
    {
        if (!$this->session->exists('yes_delete'))
            Framework\Url\HeaderUrl::redirect(Uri::get('affiliate', 'account', 'delete'));
        else
            $this->output();
    }

    public function activate($sMail, $sHash)
    {
        (new UserCore)->activateAccount($sMail, $sHash, 'affiliate');
    }

}
