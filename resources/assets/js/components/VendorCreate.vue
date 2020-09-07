<template>
    <form method="POST" v-on:submit.prevent="submit">
        <div class="alert alert-success" v-if="isSuccess.status" role="alert">{{ isSuccess.message }}</div>
        <div class="alert alert-danger" v-if="isError.status" role="alert">{{ isError.message }}</div>
        <!-- <input type="hidden" name="_method" value="PUT"> -->
        <div class="form-group" v-bind:class="{'has-error': errors.code}">
            <label for="code">Code</label>
            <input type="text" class="form-control" name="code" v-model="fields.code" id="code">
            <span v-if="errors.code" class="help-block">{{ errors.code.toString() }}</span>
        </div>

        <div class="form-group" v-bind:class="{'has-error': errors.name}">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" v-model="fields.name" id="name">
            <span v-if="errors.name" class="help-block">{{ errors.name.toString() }}</span>
        </div>

        <div class="form-group">
            <label for="address1">Address 1</label>
            <input type="text" class="form-control" name="address1" v-model="fields.address1" id="address1">
        </div>

        <div class="form-group">
            <label for="address2">Address 2</label>
            <input type="text" class="form-control" name="address2" v-model="fields.address2" id="address2">
        </div>

        <div class="form-group">
            <label for="address3">Address 3</label>
            <input type="text" class="form-control" name="address3" v-model="fields.address3" id="address3">
        </div>

        <div class="form-group">
            <label for="address4">Address 4</label>
            <input type="text" class="form-control" name="address4" v-model="fields.address4" id="address4">
        </div>

        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text" class="form-control" name="postal_code" v-model="fields.postal_code" id="postal_code">
        </div>

        <div class="form-group">
            <label for="country_code">Country Code</label>
            <input type="text" class="form-control" name="country_code" v-model="fields.country_code" id="country_code">
        </div>

        <div class="form-group">
            <label for="terms">Payment terms</label>
            <input type="text" class="form-control" name="terms" v-model="fields.terms" id="terms">
        </div>

        <div class="form-group">
            <label for="payment_method">Payment method</label>
            <input type="text" class="form-control" name="payment_method" v-model="fields.payment_method" id="payment_method">
        </div>

        <div class="form-group">
            <label for="bank_code">Bank code</label>
            <input type="text" class="form-control" name="bank_code" v-model="fields.bank_code" id="bank_code">
        </div>

        <div class="form-group">
            <label for="contact">Contact</label>
            <input type="text" class="form-control" name="contact" v-model="fields.contact" id="contact">
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" v-model="fields.phone" id="phone">
        </div>

        <div class="form-group">
            <label for="fax">Fax</label>
            <input type="text" class="form-control" name="fax" v-model="fields.fax" id="fax">
        </div>

        <div class="form-group">
            <label for="other">Other</label>
            <input type="text" class="form-control" name="other" v-model="fields.other" id="other">
        </div>

        <div class="form-group">
            <label for="tin">Tax identification number</label>
            <input type="text" class="form-control" name="tin" v-model="fields.tin" id="tin">
        </div>

        <div class="form-group">
            <label for="vat_code">Vat code</label>
            <input type="text" class="form-control" name="vat_code" v-model="fields.vat_code" id="vat_code">
        </div>

        <div class="form-group">
            <label for="ewt_code">Ewt code</label>
            <input type="text" class="form-control" name="ewt_code" v-model="fields.ewt_code" id="ewt_code">
        </div>
        
        <input type="submit" value="Create" class="btn btn-success btn-block">
    </form>
</template>

<script>
export default {
    data() {
        return {
            fields: {},
            errors: {},
            isSuccess: {
                status: false,
                message: '', 
            },
            isError: {
                status: false,
                message: '',
            }
        }
    },

    methods: {
        submit() {
            this.errors = {};
            this.isError.status = false;
            this.isSuccess.status = false;

            axios.post('/vendor', this.fields)
            .then((response) => {               
                if (response.data.status) {
                    this.isSuccess.status = response.data.status;
                    this.isSuccess.message = response.data.message;
                    this.fields = {};   
                } else {
                    this.errors = response.data.errors;
                }
            }).catch(function(error) {
                this.isError.status = true;
                this.isError.message = 'Error processing your request!';
            });
        }
    }
}
</script>