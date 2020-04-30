export default function alertsComponent() {
    return {
        alerts: {
            messages: [],
            dismiss (index) {
                this.messages.splice(index, 1);
            },
            listenForEvents () {
                window.addEventListener('addAlertMessage', (e) => this.handleNewMessage(e));

                if (window.livewire) {
                    window.livewire.on('addAlertMessage', (e) => this.handleNewMessage(e));
                }
            },
            handleNewMessage (e) {
                this.messages.push(e.detail || 'Something went wrong!');
            },
        },
    };
}

export function setup () {
    window.alertsComponent = alertsComponent;
}
