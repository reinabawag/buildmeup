<template>
    <div>
        <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Code</th>
      <th scope="col">Name</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="vendor in vendors" :key="vendor.id" @click="vendorClicked(vendor)">
      <td scope="row">{{ vendor.code }}</td>
      <td>{{ vendor.name }}</td>
    </tr>
  </tbody>
</table>
    </div>
</template>

<script>
export default {
    props: {
        vendors: {
            type: Array,
            required: true
        },
        user: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            vendor: {}
        }        
    },

    methods: {
        vendorClicked(vendor) {
            this.vendor = vendor;
        }
    }
}
</script>

<style scoped>
tr {
    cursor: pointer;
}
</style>