<?php

namespace NF\ForumAgreement\Admin\Controller;

use XF\Entity\AbstractNode;
use XF\Entity\Node;
use XF\Mvc\FormAction;

class Forum extends XFCP_Forum
{
    /**
     * @param FormAction $form
     * @param Node $node
     * @param \XF\Entity\Forum|AbstractNode $data
     */
    protected function saveTypeData(FormAction $form, Node $node, AbstractNode $data)
    {
        parent::saveTypeData($form, $node, $data);

        $form->setup(function() use ($data)
        {
            $data->forum_agreement_enabled = $this->filter('forum_agreement_enabled', 'bool');
            $data->forum_agreement_message = $this->filter('forum_agreement_message', 'str');
            $data->forum_agreement_expiry = $this->filter('forum_agreement_expiry', 'int');
        });
    }
}