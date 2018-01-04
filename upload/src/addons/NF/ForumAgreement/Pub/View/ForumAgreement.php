<?php
namespace NF\ForumAgreement\Pub\View;

use XF\Mvc\View;
class ForumAgreement extends View
{
    public function renderHtml()
    {
        $this->params['agreementParsed'] = html_entity_decode(
            \XF::app()->bbCode()->render($this->params['forum']->forum_agreement_message, 'editorHtml', $this->params['forum']->node_id, null)
        );
    }
}