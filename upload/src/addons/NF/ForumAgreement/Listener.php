<?php

namespace NF\ForumAgreement;
use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Manager;
use XF\Mvc\Entity\Structure;

class Listener
{
    public static function forumEntityStructure(Manager $em, Structure &$structure)
    {
        $structure->columns += [
            'forum_agreement_enabled'       => ['type' => Entity::BOOL, 'default' => false],
            'forum_agreement_message'       => ['type' => Entity::STR],
            'forum_agreement_expiry'        => ['type' => Entity::INT]
        ];
    }
}