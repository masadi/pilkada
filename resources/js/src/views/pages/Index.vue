<template>
  <div>
    <b-row v-if="isBusy">
      <b-col>
        <b-card class="text-center">
          <div class="text-center text-danger my-2">
            <b-spinner class="align-middle"></b-spinner>
            <div><strong>Loading...</strong></div>
          </div>
        </b-card>
      </b-col>
    </b-row>
    <b-row v-else>
      <b-col>
        <b-card>
          <b-card-text>
            <h2 class="fw-bolder">SELAMAT DATANG</h2>
            <b-table-simple responsive striped bordered v-if="user">
              <b-tbody>
                <b-tr>
                  <b-td width="20%">Kecamatan</b-td>
                  <b-td width="80%">{{ user.tps.desa.kecamatan.nama }}</b-td>
                </b-tr>
                <b-tr>
                  <b-td>Desa/Kelurahan</b-td>
                  <b-td>{{ user.tps.desa.nama }}</b-td>
                </b-tr>
                <b-tr>
                  <b-td>Nomor TPS</b-td>
                  <b-td>{{ user.tps.nama }}</b-td>
                </b-tr>
              </b-tbody>
            </b-table-simple>
            <b-tabs content-class="mt-2" justified class="mt-4">
              <b-tab v-for="item in items" :key="item.id" :title="`PEMILIHAN ${item.nama}`">
                <b-form @submit.prevent="handleSubmit(item.id)">
                  <b-card-text>
                    <h2>I. DATA PEMILIH DAN PENGGUNA HAK PILIH</h2>
                    <b-table-simple responsive bordered>
                      <b-thead>
                        <b-tr>
                          <b-th class="text-center" width="55%">URAIAN</b-th>
                          <b-th class="text-center" width="15%">LAKI-LAKI (L)</b-th>
                          <b-th class="text-center" width="15%">PEREMPUAN (P)</b-th>
                          <b-th class="text-center" width="15%">JUMLAH (L+P)</b-th>
                        </b-tr>
                      </b-thead>
                      <b-tbody>
                        <b-tr>
                          <b-td colspan="4" class="text-bold">A. DATA PEMILIH</b-td>
                        </b-tr>
                        <DataPemilih :form="form" :state="state" :feedback="feedback" :id="item.id" @jml-dpt="sumDpt"></DataPemilih>
                        <b-tr>
                          <b-td colspan="4" class="text-bold">B. PENGGUNA HAK PILIH</b-td>
                        </b-tr>
                        <PenggunaHakPilihDpt :form="form" :state="state" :feedback="feedback" :id="item.id" @jml-dpt="sumPenggunaDpt"></PenggunaHakPilihDpt>
                        <PenggunaHakPilihDptB :form="form" :state="state" :feedback="feedback" :id="item.id" @jml-dpt="sumPenggunaDptB"></PenggunaHakPilihDptB>
                        <PenggunaHakPilihDptK :form="form" :state="state" :feedback="feedback" :id="item.id" @jml-dpt="sumPenggunaDptK"></PenggunaHakPilihDptK>
                        <JumlahPenggunaHakPilih :form="form" :id="item.id"></JumlahPenggunaHakPilih>
                      </b-tbody>
                    </b-table-simple>
                    <h2>II. DATA PENGGUNAAN HAK SUARA</h2>
                    <PenggunaanHakSuara :form="form" :state="state" :feedback="feedback" :id="item.id" @jml-dpt="hitungTotal"></PenggunaanHakSuara>
                    <h2>III. DATA PEMILIH DISABILITAS</h2>
                    <DataPemilihDisabilitas :form="form" :id="item.id" @jml-dpt="sumDisabilitas"></DataPemilihDisabilitas>
                    <h2>IV. DATA RINCIAN PEROLEHAN SUARA SAH PASANGAN CALON {{ item.nama }} </h2>
                    <b-table-simple responsive bordered>
                      <b-thead>
                        <b-tr>
                          <b-th colspan="2" width="85%">NOMOR DAN NAMA PASANGAN CALON</b-th>
                          <b-th class="text-center" width="15%">JUMLAH SUARA SAH</b-th>
                        </b-tr>
                      </b-thead>
                      <b-tbody>
                        <PerolehanSuara v-for="paslon in item.paslon" :key="paslon.id" :form="form" :id="item.id" :paslon="paslon" @jml-dpt="sumSuaraSah"></PerolehanSuara>
                      </b-tbody>
                    </b-table-simple>
                    <h2>V. DATA SUARA SAH DAN SUARA TIDAK SAH</h2>
                    <b-table-simple responsive bordered>
                      <b-thead>
                        <b-tr>
                          <b-th width="85%">NOMOR DAN NAMA PASANGAN CALON</b-th>
                          <b-th class="text-center" width="15%">JUMLAH SUARA SAH</b-th>
                        </b-tr>
                      </b-thead>
                      <b-tbody>
                        <b-tr>
                          <b-td class="text-bold">
                            A. JUMLAH SELURUH SUARA SAH (IV.1 + IV.2 + IV.3)
                          </b-td>
                          <b-td class="text-center">
                            <b-form-input v-model="form.jml_suara_sah[item.id]" type="number" readonly></b-form-input>
                          </b-td>
                        </b-tr>
                        <b-tr>
                          <b-td class="text-bold">B. JUMLAH SUARA TIDAK SAH</b-td>
                          <b-td class="text-center">
                            <b-form-input v-model="form.jml_suara_tidak_sah[item.id]" type="number" readonly></b-form-input>
                          </b-td>
                        </b-tr>
                      </b-tbody>
                    </b-table-simple>
                  </b-card-text>
                  <b-button variant="primary" type="submit">SIMPAN</b-button>
                </b-form>
              </b-tab>
            </b-tabs>
          </b-card-text>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import { BRow, BCol, BSpinner, BCard, BCardText, BTab, BTabs, BTableSimple, BTbody, BThead, BTr, BTd, BTh, BForm, BButton, BFormInput,  BFormInvalidFeedback} from 'bootstrap-vue'
import DataPemilih from '../components/DataPemilih.vue';
import DataPemilihDisabilitas from '../components/DataPemilihDisabilitas.vue';
import JumlahPenggunaHakPilih from '../components/JumlahPenggunaHakPilih.vue';
import PenggunaanHakSuara from '../components/PenggunaanHakSuara.vue';
import PenggunaHakPilihDpt from '../components/PenggunaHakPilihDpt.vue';
import PenggunaHakPilihDptB from '../components/PenggunaHakPilihDptB.vue';
import PenggunaHakPilihDptK from '../components/PenggunaHakPilihDptK.vue';
import PerolehanSuara from '../components/PerolehanSuara.vue';
export default {
  components: {
    DataPemilih, PenggunaHakPilihDpt, PenggunaHakPilihDptB, PenggunaHakPilihDptK, JumlahPenggunaHakPilih, PenggunaanHakSuara, DataPemilihDisabilitas, PerolehanSuara,
    BRow, BCol, BSpinner, BCard, BCardText, BTab, BTabs, BTableSimple, BTbody, BThead, BTr, BTd, BTh, BForm,
    BButton, BFormInput, BFormInvalidFeedback
  },
  data() {
    return {
      isBusy: true,
      user: null,
      items: [],
      paslon: [],
      form: {
        data_pemilih: {
          dpt_l: {},
          dpt_p: {},
          jml_dpt: {
            1: 0,
            2: 0,
          },
        },
        pengguna_hak_pilih: {
          dpt_l: {
            1: null,
            2: null,
          },
          dpt_p: {
            1: null,
            2: null,
          },
          jml_dpt: {
            1: 0,
            2: 0,
          },
          dpt_bl: {
            1: null,
            2: null,
          },
          dpt_bp: {
            1: null,
            2: null,
          },
          jml_dptb: {
            1: 0,
            2: 0,
          },
          dpt_kl: {
            1: null,
            2: null,
          },
          dpt_kp: {
            1: null,
            2: null,
          },
          jml_dptk: {
            1: 0,
            2: 0,
          },
          jml_pengguna_l: {
            1: 0,
            2: 0,
          },
          jml_pengguna_p: {
            1: 0,
            2: 0,
          },
          jml_pengguna: {
            1: 0,
            2: 0,
          },
        },
        penggunaan: {
          jml_surat_suara: {
            1: 0,
            2: 0,
          },
          digunakan: {
            1: 0,
            2: 0,
          },
          dikembalikan: {
            1: 0,
            2: 0,
          },
          tidak_terpakai: {
            1: null,
            2: null,
          },
        },
        disabilitas:{
          dis_l: {
            1: 0,
            2: 0,
          },
          dis_p: {
            1: 0,
            2: 0,
          },
          jml_dpt: {
            1: 0,
            2: 0,
          },
        },
        suara_sah: {
          1: {},
          2: {},
        },
        jml_suara_sah: {
          1: 0,
          2: 0,
        },
        jml_suara_tidak_sah: {
          1: 0,
          2: 0,
        }
      },
      state: {
        data_pemilih: {
          dpt_l: {},
          dpt_p: {},
        },
        pengguna_hak_pilih: {
          dpt_l: {},
          dpt_p: {},
          dpt_bl: {},
          dpt_bp: {},
          dpt_kl: {},
          dpt_kp: {},
        },
        penggunaan: {
          dikembalikan: {}
        },
      },
      feedback: {
        data_pemilih: {
          dpt_l: {},
          dpt_p: {},
        },
        pengguna_hak_pilih: {
          dpt_l: {},
          dpt_p: {},
          dpt_bl: {},
          dpt_bp: {},
          dpt_kl: {},
          dpt_kp: {},
        },
        penggunaan: {
          dikembalikan: {}
        },
      },
    }
  },
  created() {
    this.loadData()
  },
  methods: {
    loadData(){
      this.$http.get('/dashboard').then(response => {
        let getData = response.data
        this.user = getData.user
        this.items = getData.pemilu
        var _this = this
        this.items.forEach(item => {
          _this.form.data_pemilih.dpt_l[item.id] = this.user.tps.dpt_l
          _this.form.data_pemilih.dpt_p[item.id] = this.user.tps.dpt_p
          _this.form.data_pemilih.jml_dpt[item.id] = this.user.tps.dpt_l + this.user.tps.dpt_p
          _this.form.penggunaan.jml_surat_suara[item.id] = _this.form.data_pemilih.jml_dpt[item.id] + this.user.tps.tambahan
          item.paslon.forEach(paslon => {
            _this.form.suara_sah[item.id][paslon.id] = paslon.sah
          });
          if(item.hak_pilih){
            _this.form.pengguna_hak_pilih.dpt_l[item.id] = item.hak_pilih.dpt_l
            _this.form.pengguna_hak_pilih.dpt_p[item.id] = item.hak_pilih.dpt_p
            _this.form.pengguna_hak_pilih.jml_dpt[item.id] = item.hak_pilih.dpt_l + item.hak_pilih.dpt_p
            _this.form.pengguna_hak_pilih.dpt_bl[item.id] = item.hak_pilih.dpt_bl
            _this.form.pengguna_hak_pilih.dpt_bp[item.id] = item.hak_pilih.dpt_bp
            _this.form.pengguna_hak_pilih.jml_dptb[item.id] = item.hak_pilih.dpt_bl + item.hak_pilih.dpt_bp
            _this.form.pengguna_hak_pilih.dpt_kl[item.id] = item.hak_pilih.dpt_kl
            _this.form.pengguna_hak_pilih.dpt_kp[item.id] = item.hak_pilih.dpt_kp
            _this.form.pengguna_hak_pilih.jml_dptk[item.id] = item.hak_pilih.dpt_kl + item.hak_pilih.dpt_kp
            _this.form.pengguna_hak_pilih.jml_pengguna_l[item.id] = item.hak_pilih.dpt_l + item.hak_pilih.dpt_bl + item.hak_pilih.dpt_kl
            _this.form.pengguna_hak_pilih.jml_pengguna_p[item.id] = item.hak_pilih.dpt_p + item.hak_pilih.dpt_bp + item.hak_pilih.dpt_kp
            _this.form.pengguna_hak_pilih.jml_pengguna[item.id] = _this.form.pengguna_hak_pilih.jml_pengguna_l[item.id] + _this.form.pengguna_hak_pilih.jml_pengguna_p[item.id]
            _this.form.disabilitas.dis_l[item.id] = item.hak_pilih.dis_l
            _this.form.disabilitas.dis_p[item.id] = item.hak_pilih.dis_p
            _this.form.disabilitas.jml_dpt[item.id] = item.hak_pilih.dis_l + item.hak_pilih.dis_p
          }
          if(item.surat_suara){
            _this.form.penggunaan.digunakan[item.id] = item.surat_suara.digunakan
            _this.form.penggunaan.dikembalikan[item.id] = item.surat_suara.dikembalikan
            _this.form.penggunaan.tidak_terpakai[item.id] = item.surat_suara.tidak_terpakai
          }
          if(item.suara){
            _this.form.jml_suara_sah[item.id] = item.suara.sah
            _this.form.jml_suara_tidak_sah[item.id] = item.suara.tidak_sah
          } else {
            _this.form.jml_suara_sah[item.id] = this.sumValues(_this.form.suara_sah[item.id])
            _this.form.jml_suara_tidak_sah[item.id] = _this.form.pengguna_hak_pilih.jml_pengguna[item.id] - _this.form.jml_suara_sah[item.id]
          }
        });
        this.isBusy = false
      })
    },
    sumDpt(params){
      this.form.data_pemilih.jml_dpt[params.id] = params.sum
    },
    sumPenggunaDpt(params){
      this.form.pengguna_hak_pilih.jml_dpt[params.id] = params.sum
    },
    sumPenggunaDptB(params){
      this.form.pengguna_hak_pilih.jml_dptb[params.id] = params.sum
      this.total(params.id)
    },
    sumPenggunaDptK(params){
      this.form.pengguna_hak_pilih.jml_dptk[params.id] = params.sum
      this.total(params.id)
    },
    total(id){
      this.form.pengguna_hak_pilih.jml_pengguna_l[id] = parseInt(this.form.pengguna_hak_pilih.dpt_l[id]) + parseInt(this.form.pengguna_hak_pilih.dpt_bl[id]) + parseInt(this.form.pengguna_hak_pilih.dpt_kl[id])
      this.form.pengguna_hak_pilih.jml_pengguna_p[id] = parseInt(this.form.pengguna_hak_pilih.dpt_p[id]) + parseInt(this.form.pengguna_hak_pilih.dpt_bp[id]) + parseInt(this.form.pengguna_hak_pilih.dpt_kp[id])
      this.form.pengguna_hak_pilih.jml_pengguna[id] = parseInt(this.form.pengguna_hak_pilih.jml_pengguna_l[id]) + parseInt(this.form.pengguna_hak_pilih.jml_pengguna_p[id])
      this.form.penggunaan.digunakan[id] = this.form.pengguna_hak_pilih.jml_pengguna[id]
    },
    hitungTotal(params){
      this.form.penggunaan.tidak_terpakai[params.id] = this.form.penggunaan.jml_surat_suara[params.id] - (this.form.penggunaan.digunakan[params.id] + parseInt(params.sum))
    },
    sumDisabilitas(params){
      this.form.disabilitas.jml_dpt[params.id] = params.sum
    },
    sumSuaraSah(params){
      this.form.jml_suara_sah[params.id] = this.sumValues(this.form.suara_sah[params.id])
      this.form.jml_suara_tidak_sah[params.id] = this.form.pengguna_hak_pilih.jml_pengguna[params.id] - this.form.jml_suara_sah[params.id]
    },
    sumValues(obj){
      return Object.values(obj).reduce((a, b) => parseInt(a) + parseInt(b), 0)
    },
    handleSubmit(id){
      this.form.id = id
      this.$http.post('/dashboard', this.form).then(response => {
        let getData = response.data
        if(getData.errors){
          var _this = this
          var s_data_pemilih_dpt_l = {}
          var f_pemilih_dpt_l = {}
          var s_pemilih_dpt_p = {}
          var f_pemilih_dpt_p = {}
          var s_pengguna_hak_pilih_l = {}
          var s_pengguna_hak_pilih_p = {}
          var f_pengguna_hak_pilih_l = {}
          var f_pengguna_hak_pilih_p = {}
          var s_pengguna_hak_pilih_dpt_bl = {}
          var s_pengguna_hak_pilih_dpt_bp = {}
          var s_pengguna_hak_pilih_dpt_kl = {}
          var s_pengguna_hak_pilih_dpt_kp = {}
          var f_pengguna_hak_pilih_dpt_bl = {}
          var f_pengguna_hak_pilih_dpt_bp = {}
          var f_pengguna_hak_pilih_dpt_kl = {}
          var f_pengguna_hak_pilih_dpt_kp = {}
          var s_dikembalikan = {}
          var f_dikembalikan = {}
          
          this.items.forEach(item => {
            s_data_pemilih_dpt_l[item.id] = (getData.errors['data_pemilih.dpt_l.'+item.id]) ? false : null
            f_pemilih_dpt_l[item.id] = (getData.errors['data_pemilih.dpt_l.'+item.id]) ? getData.errors['data_pemilih.dpt_l.'+item.id].join(', ') : ''
            s_pemilih_dpt_p[item.id] = (getData.errors['data_pemilih.dpt_p.'+item.id]) ? false : null
            f_pemilih_dpt_p[item.id] = (getData.errors['data_pemilih.dpt_p.'+item.id]) ? getData.errors['data_pemilih.dpt_p.'+item.id].join(', ') : ''
            s_pengguna_hak_pilih_l[item.id] = (getData.errors['pengguna_hak_pilih.dpt_l.'+item.id]) ? false : null
            f_pengguna_hak_pilih_l[item.id] = (getData.errors['pengguna_hak_pilih.dpt_l.'+item.id]) ? getData.errors['pengguna_hak_pilih.dpt_l.'+item.id].join(', ') : ''
            s_pengguna_hak_pilih_p[item.id] = (getData.errors['pengguna_hak_pilih.dpt_p.'+item.id]) ? false : null
            f_pengguna_hak_pilih_p[item.id] = (getData.errors['pengguna_hak_pilih.dpt_p.'+item.id]) ? getData.errors['pengguna_hak_pilih.dpt_p.'+item.id].join(', ') : ''

            s_pengguna_hak_pilih_dpt_bl[item.id] = (getData.errors['pengguna_hak_pilih.dpt_bl.'+item.id]) ? false : null
            s_pengguna_hak_pilih_dpt_bp[item.id] = (getData.errors['pengguna_hak_pilih.dpt_bp.'+item.id]) ? false : null
            s_pengguna_hak_pilih_dpt_kl[item.id] = (getData.errors['pengguna_hak_pilih.dpt_kl.'+item.id]) ? false : null
            s_pengguna_hak_pilih_dpt_kp[item.id] = (getData.errors['pengguna_hak_pilih.dpt_kp.'+item.id]) ? false : null
            
            f_pengguna_hak_pilih_dpt_bl[item.id] = (getData.errors['pengguna_hak_pilih.dpt_bl.'+item.id]) ? getData.errors['pengguna_hak_pilih.dpt_bl.'+item.id].join(', ') : ''
            f_pengguna_hak_pilih_dpt_bp[item.id] = (getData.errors['pengguna_hak_pilih.dpt_bp.'+item.id]) ? getData.errors['pengguna_hak_pilih.dpt_bp.'+item.id].join(', ') : ''
            f_pengguna_hak_pilih_dpt_kl[item.id] = (getData.errors['pengguna_hak_pilih.dpt_kl.'+item.id]) ? getData.errors['pengguna_hak_pilih.dpt_kl.'+item.id].join(', ') : ''
            f_pengguna_hak_pilih_dpt_kp[item.id] = (getData.errors['pengguna_hak_pilih.dpt_kp.'+item.id]) ? getData.errors['pengguna_hak_pilih.dpt_kp.'+item.id].join(', ') : ''

            s_dikembalikan[item.id] = (getData.errors['penggunaan.dikembalikan.'+item.id]) ? false : null
            f_dikembalikan[item.id] = (getData.errors['penggunaan.dikembalikan.'+item.id]) ? getData.errors['penggunaan.dikembalikan.'+item.id].join(', ') : ''
          })
          
          this.state.data_pemilih.dpt_l = s_data_pemilih_dpt_l
          this.state.data_pemilih.dpt_p = s_pemilih_dpt_p
          this.state.pengguna_hak_pilih.dpt_l = s_pengguna_hak_pilih_l
          this.state.pengguna_hak_pilih.dpt_p = s_pengguna_hak_pilih_p
          
          this.feedback.data_pemilih.dpt_l = f_pemilih_dpt_l
          this.feedback.data_pemilih.dpt_p = f_pemilih_dpt_p
          this.feedback.pengguna_hak_pilih.dpt_l = f_pengguna_hak_pilih_l
          this.feedback.pengguna_hak_pilih.dpt_p = f_pengguna_hak_pilih_p
          
          this.state.pengguna_hak_pilih.dpt_bl = s_pengguna_hak_pilih_dpt_bl
          this.state.pengguna_hak_pilih.dpt_bp = s_pengguna_hak_pilih_dpt_bp
          this.state.pengguna_hak_pilih.dpt_kl = s_pengguna_hak_pilih_dpt_kl
          this.state.pengguna_hak_pilih.dpt_kp = s_pengguna_hak_pilih_dpt_kp

          this.feedback.pengguna_hak_pilih.dpt_bl = f_pengguna_hak_pilih_dpt_bl
          this.feedback.pengguna_hak_pilih.dpt_bp = f_pengguna_hak_pilih_dpt_bp
          this.feedback.pengguna_hak_pilih.dpt_kl = f_pengguna_hak_pilih_dpt_kl
          this.feedback.pengguna_hak_pilih.dpt_kp = f_pengguna_hak_pilih_dpt_kp

          this.state.penggunaan.dikembalikan = s_dikembalikan
          this.feedback.penggunaan.dikembalikan = f_dikembalikan
        } else {
          this.$swal({
            icon: getData.icon,
            title: getData.title,
            text: getData.text,
            customClass: {
              confirmButton: 'btn btn-success',
            },
            allowOutsideClick: false,
          })
        }
      });
    },
  }
}
</script>
<style lang="scss">
.text-bold {font-weight: bold;}
@import '~@resources/scss/vue/libs/vue-sweetalert.scss';
</style>