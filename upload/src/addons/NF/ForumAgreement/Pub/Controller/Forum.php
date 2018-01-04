<?php

namespace NF\ForumAgreement\Pub\Controller;

use XF\Mvc\ParameterBag;

class Forum extends XFCP_Forum
{
    public function actionPostThread(ParameterBag $params)
    {
        if (!$params->get('node_id') && !$params->get('node_name'))
        {
            return $this->rerouteController('XF:Forum', 'postThreadChooser');
        }

        /** @var \XF\Entity\Forum $forum */
        $forum = $this->assertViewableForum($params->get('node_id') ?: $params->get('node_name'), ['DraftThreads|' . \XF::visitor()->user_id]);

        if ($forum->forum_agreement_enabled)
        {
            $cookieName = 'forumAgreement_' . $params->get('node_id');
            $cookie = $this->app->response()->getCookie($cookieName);
            $showMessage = true;

            if ($cookie AND $forum['forum_agreement_expiry'] != 0)
            {
                $showMessage = false;
            }

            if ($this->isPost())
            {
                $time = $forum['forum_agreement_expiry'] > 0 ? (time() + $forum['forum_agreement_expiry'] * 60 * 60 * 24) : 60 * 60 * 24;
                $showMessage = !($this->app->response()->setCookie($cookieName, $params->get('node_id'), $time));
            }

            if ($showMessage)
            {
                $viewParams = array(
                    'forum' => $forum,
                    'homeLink' => $this->buildLink('index')
                );

                return $this->view('NF\ForumAgreement:ForumAgreement', 'nf_forumagreement_agreement', $viewParams);
            }
        }

        return parent::actionPostThread($params);
    }
}