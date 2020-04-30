<div
    class="container"
    x-data="{ ...alertsComponent() }"
    x-init="alerts.listenForEvents()"
>
    <template x-for="(item, index) in alerts.messages">
        <div x-on:click="alerts.dismiss(index)" x-text="item" class="alert alert-primary" ></div>
    </template>
</div>
