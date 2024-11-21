<template>
  <b-tr>
    <b-td class="text-center text-bold">
      {{ paslon.nomor_urut }}
    </b-td>
    <b-td class="text-bold">
      {{ paslon.nama }}
    </b-td>
    <b-td style="vertical-align: top;">
      <b-form-input v-model="form.suara_sah[id][paslon.id]" type="number" @input="jmlDpt(id, paslon.id)"></b-form-input>
    </b-td>
  </b-tr>
</template>

<script>
import { BTr, BTd, BFormInput } from 'bootstrap-vue'
export default {
  components: {
    BTr, BTd, BFormInput
  },
  props: {
    form: {
      type: Object,
      required: true
    },
    id: {
      type: Number,
      required: true
    },
    paslon: {
      type: Object,
      required: true
    },
  },
  methods: {
    jmlDpt(id, paslon_id) {
      this.$emit('jml-dpt', {
        id: id,
        paslon_id: paslon_id,
        val: this.form.suara_sah[id][paslon_id],
      })
    }
  }
}
</script>