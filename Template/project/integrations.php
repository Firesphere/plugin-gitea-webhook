<h3><img src="<?= $this->url->dir() ?>plugins/GiteaWebhook/gitea-sm.png"/>&nbsp;<?= t('Gitea webhooks') ?></h3>
<div class="panel">
    <input type="text" class="auto-select" readonly="readonly" value="<?= $this->url->href('WebhookController', 'handler', ['plugin' => 'GiteaWebhook', 'token' => $webhook_token, 'project_id' => $project['id']], false, '', true) ?>"/>
    <p class="form-help"><a href="https://github.com/chriswep/plugin-gitea-webhook#documentation" target="_blank"><?= t('Help on Gitea webhooks') ?></a></p>
</div>
