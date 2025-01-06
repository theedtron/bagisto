<div class="form-group" id="mpesa-form" style="display: none;">
    <label for="mpesa_phone" class="form-label">
        Phone Number
        <span class="text-red-600">*</span>
    </label>

    <input 
        type="text" 
        name="mpesa_phone" 
        id="mpesa_phone" 
        class="form-control" 
        v-model="mpesa_phone"
        placeholder="Enter M-Pesa phone number e.g 254712345678"
        required
    />
</div>

@push('scripts')
<script type="text/x-template" id="mpesa-form-template">
    <div>
        <div class="form-group" v-if="isSelected">
            <label for="mpesa_phone" class="form-label">
                Phone Number
                <span class="text-red-600">*</span>
            </label>

            <input 
                type="text" 
                name="mpesa_phone" 
                id="mpesa_phone" 
                class="form-control" 
                v-model="mpesa_phone"
                placeholder="Enter M-Pesa phone number e.g 254712345678"
                required
            />
        </div>
    </div>
</script>

<script>
    Vue.component('mpesa-form', {
        template: '#mpesa-form-template',

        data: function() {
            return {
                mpesa_phone: '',
                isSelected: false
            }
        },

        mounted: function() {
            // Listen for payment method changes
            eventBus.$on('after-payment-method-selected', this.handlePaymentMethodSelected);
        },

        methods: {
            handlePaymentMethodSelected: function(payment) {
                this.isSelected = payment.payment_method === 'mpesa';
                
                if (this.isSelected) {
                    this.$parent.mpesa_phone = this.mpesa_phone;
                }
            }
        }
    });
</script>
@endpush