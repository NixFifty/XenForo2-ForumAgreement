<?php
namespace NF\ForumAgreement;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;
class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    public function install(array $stepParams = [])
    {
        $this->schemaManager()->alterTable('xf_forum', function (Alter $table)
        {
            $table->addColumn('forum_agreement_enabled', 'int')->unsigned()->setDefault(0);
            $table->addColumn('forum_agreement_message', 'text');
            $table->addColumn('forum_agreement_expiry', 'int')->unsigned()->setDefault(1);
        });
    }

    public function upgrade(array $stepParams = [])
    {
        // TODO: Implement upgrade() method.
    }

    public function uninstall(array $stepParams = [])
    {
        $this->schemaManager()->alterTable('xf_forum', function (Alter $table)
        {
            $table->dropColumns([
               'forum_agreement_enabled', 'forum_agreement_message', 'forum_agreement_expiry'
            ]);
        });
    }
}