<template>
  <div>
    <form-progress></form-progress>
    <div class="bg-white shadow relative">
      <loading
        :active.sync="isLoading"
        :can-cancel="true"
        :is-full-page="true"
        color="#007BFF"
      />
      <!-- Uploads -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Uploads</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-6">
            <div v-if="idTypeIsKtp" class="w-full md:w-1/2">
              <label class="form-label"
                >Upload KTP <span class="form-required">*</span></label
              >
              <file-pond
                name="upload_ktp"
                ref="uploadKtp"
                label-idle="Drop files here..."
                v-bind:allow-multiple="false"
                accepted-file-types="image/jpeg, image/png"
                v-bind:server="uploadServer"
                v-bind:files="uploadKtp"
                v-on:processfile="processKtp"
                v-on:removefile="removeKtp"
              />
              <div
                v-if="$v.upload_ktp.$error && !$v.upload_ktp.required"
                class="form-validation-error"
              >
                <small>Upload KTP wajib diisi.</small>
              </div>
            </div>
            <div v-if="idTypeIsPassport" class="w-full md:w-1/2">
              <label class="form-label"
                >Upload Passport <span class="form-required">*</span></label
              >
              <file-pond
                name="upload_passport"
                ref="uploadPassport"
                label-idle="Drop files here..."
                v-bind:allow-multiple="false"
                accepted-file-types="image/jpeg, image/png"
                v-bind:server="uploadServer"
                v-bind:files="uploadPassport"
                v-on:processfile="processPassport"
                v-on:removefile="removePassport"
              />
              <div
                v-if="$v.upload_passport.$error && !$v.upload_passport.required"
                class="form-validation-error"
              >
                <small>Upload Passport wajib diisi.</small>
              </div>
            </div>
            <div v-if="hasNpwp" class="w-full md:w-1/2">
              <label class="form-label"
                >Upload NPWP <span class="form-required">*</span></label
              >
              <file-pond
                name="upload_npwp"
                ref="uploadNpwp"
                label-idle="Drop files here..."
                v-bind:allow-multiple="false"
                accepted-file-types="image/jpeg, image/png"
                v-bind:server="uploadServer"
                v-bind:files="uploadNpwp"
                v-on:processfile="processNpwp"
                v-on:removefile="removeNpwp"
              />
              <div
                v-if="$v.upload_npwp.$error && !$v.upload_npwp.required"
                class="form-validation-error"
              >
                <small>Upload NPWP wajib diisi.</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Terms -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Persyaratan &amp; Ketentuan</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="w-full">
            <div class="form-label">
              Pernyataan Pembukaan Rekening Efek
              <span class="form-required">*</span>
            </div>
            <statement-application />
            <div class="form-check mt-2 inline-flex">
              <input
                v-model="application_term"
                type="checkbox"
                name="application_term"
                id="application_term"
                class="form-check-input"
                @change="$v.application_term.$touch()"
              />
              <label
                class="form-check-label inline-block ml-2"
                for="application_term"
                >Saya dengan ini menyatakan telah membaca, memahami, dan
                menyetujui isi Pernyataan tersebut di atas.</label
              >
            </div>
            <div
              v-if="$v.application_term.$error && !$v.application_term.required"
              class="form-validation-error"
            >
              <small>Pernyataan Pembukaan Rekening Efek wajib disetujui.</small>
            </div>
          </div>

          <div class="w-full">
            <label class="form-label"
              >Pernyataan Nasabah RDN BCA
              <span class="form-required">*</span></label
            >
            <statement-bca />
            <div class="form-check mt-2 inline-flex">
              <input
                v-model="bca_term"
                type="checkbox"
                name="bca_term"
                id="bca_term"
                class="form-check-input"
              />
              <label class="form-check-label inline-block ml-2" for="bca_term"
                >Saya dengan ini menyatakan telah membaca, memahami, dan
                menyetujui isi Pernyataan tersebut di atas.</label
              >
            </div>
            <div
              v-if="$v.bca_term.$error && !$v.bca_term.required"
              class="form-validation-error"
            >
              <small>Pernyataan Nasabah RDN BCA wajib disetujui.</small>
            </div>
          </div>
        </div>
      </div>

      <!-- Signature -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Tanda Tangan Anda</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full">
              <label class="form-label"
                >Tanda Tangan <span class="form-required">*</span></label
              >
              <div class="text-sm text-gray-500 italic leading-tight mt-1 mb-2">
                Harap tanda tangan formulir registrasi di tengah kotak dan
                jangan melewati garis lalu tekan tombol simpan.
              </div>
              <div class="vue-signature-pad">
                <VueSignaturePad
                  v-model="upload_signature"
                  width="500px"
                  height="320px"
                  ref="signaturePad"
                  :options="{ backgroundColor: 'rgb(255,255,255)' }"
                />
                <div class="vue-signature-pad--actions">
                  <button
                    type="button"
                    class="button clear"
                    @click="clearSignature"
                  >
                    Ulangi
                  </button>
                  <button
                    type="button"
                    class="button save"
                    @click="saveSignature"
                  >
                    Simpan
                  </button>
                </div>
              </div>
              <div
                v-if="
                  $v.upload_signature.$error && !$v.upload_signature.required
                "
                class="form-validation-error"
              >
                <small>Tanda Tangan wajib diisi.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Buttons -->
    <div class="flex gap-4 mt-8 justify-center">
      <button
        @click="navigatePrev()"
        type="button"
        class="px-4 py-2 border rounded text-sm font-bold uppercase bg-orange border-orange text-white hover:bg-orange-light hover:border-orange-light focus:outline-none transition ease-in-out duration-150"
      >
        ⟵ Kembali
      </button>
      <button
        @click="navigateNext()"
        type="button"
        class="px-4 py-2 border rounded text-sm font-bold uppercase bg-orange border-orange text-white hover:bg-orange-light hover:border-orange-light focus:outline-none transition ease-in-out duration-150"
      >
        Berikutnya ⟶
      </button>
    </div>
  </div>
</template>

<script>
import { mutateFields } from "../../helpers/helpers.js";
import { required, sameAs, requiredIf } from "vuelidate/lib/validators";
import vSelect from "vue-select";
import vueFilePond from "vue-filepond";
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginImagePreview
);
import StatementApplication from "./StatementApplication.vue";
import StatementBCA from "./StatementBCA.vue";
import FormProgress from "./FormProgress.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  components: {
    vSelect,
    FilePond,
    Loading,
    FormProgress,
    "statement-application": StatementApplication,
    "statement-bca": StatementBCA
  },
  data() {
    return {
      isLoading: false,
      uploadKtp: [],
      uploadPassport: [],
      uploadNpwp: [],
      uploadServer: {
        url: "/api/upload",
        load: (source, load) => {
          // simulates loading a file from the server
          fetch(source)
            .then(res => res.blob())
            .then(load);
        }
      }
    };
  },
  mounted() {
    this.$store.commit("SET_STEP", "4");
    const step_validated = this.$store.getters.step_validated;
    if (step_validated < 3) {
      this.$router.push("/step-3/");
    }
    if (this.status == "complete") {
      if (this.upload_ktp) {
        this.uploadKtp = [
          {
            source: "/storage/uploads/" + this.account_id + "/KTP.jpg",
            options: {
              type: "local"
            }
          }
        ];
      }
    } else {
      if (this.upload_ktp) {
        this.uploadKtp = [
          {
            source: "/storage/uploads/tmp/" + this.upload_ktp + "/KTP.jpg",
            options: {
              type: "local"
            }
          }
        ];
      }
    }
    if (this.status == "complete") {
      if (this.upload_passport) {
        this.uploadPassport = [
          {
            source: "/storage/uploads/" + this.account_id + "/Passport.jpg",
            options: {
              type: "local"
            }
          }
        ];
      }
    } else {
      if (this.upload_passport) {
        this.uploadPassport = [
          {
            source:
              "/storage/uploads/tmp/" + this.upload_passport + "/Passport.jpg",
            options: {
              type: "local"
            }
          }
        ];
      }
    }

    if (this.status == "complete") {
      if (this.upload_npwp) {
        this.uploadNpwp = [
          {
            source: "/storage/uploads/" + this.account_id + "/NPWP.jpg",
            options: {
              type: "local"
            }
          }
        ];
      }
    } else {
      if (this.upload_npwp) {
        this.uploadNpwp = [
          {
            source: "/storage/uploads/tmp/" + this.upload_npwp + "/NPWP.jpg",
            options: {
              type: "local"
            }
          }
        ];
      }
    }

    if (this.upload_signature) {
      this.$refs.signaturePad.fromDataURL(this.upload_signature);
    }
  },
  computed: {
    ...mutateFields({
      fields: [
        "upload_ktp",
        "upload_passport",
        "upload_npwp",
        "upload_signature",
        "application_term",
        "bca_term",
        "status",
        "account_id"
      ],
      base: "fields",
      mutation: "UPDATE_FIELD"
    }),
    idTypeIsKtp() {
      if (this.$store.getters.fields.id_type === "KTP") return true;
      return false;
    },
    idTypeIsPassport() {
      if (this.$store.getters.fields.id_type === "Paspor") return true;
      return false;
    },
    hasNpwp() {
      if (this.$store.getters.fields.has_npwp != "1") return true;
      return false;
    }
  },
  validations: {
    upload_ktp: {
      required: requiredIf("idTypeIsKtp")
    },
    upload_passport: {
      required: requiredIf("idTypeIsPassport")
    },
    upload_npwp: {
      required: requiredIf("hasNpwp")
    },
    upload_signature: {
      required
    },
    application_term: {
      sameAs: sameAs(() => 1)
    },
    bca_term: {
      sameAs: sameAs(() => 1)
    }
  },
  methods: {
    processKtp(error, file) {
      this.upload_ktp = file.serverId;
    },
    removeKtp(error, file) {
      this.upload_ktp = "";
    },
    processPassport(error, file) {
      this.upload_passport = file.serverId;
    },
    removePassport(error, file) {
      this.upload_passport = "";
    },
    processNpwp(error, file) {
      this.upload_npwp = file.serverId;
    },
    removeNpwp(error, file) {
      this.upload_npwp = "";
    },
    clearSignature() {
      this.$refs.signaturePad.clearSignature();
      this.upload_signature = "";
    },
    saveSignature() {
      const { isEmpty, data } = this.$refs.signaturePad.saveSignature();
      //console.log(data);
      this.upload_signature = data;
    },
    navigatePrev() {
      this.$router.push("/step-3");
    },
    navigateNext() {
      this.$v.$touch();
      if (this.$v.$error) return;
      this.status = "complete";
      this.storeData();
    },
    async storeData() {
      await this.$store
        .dispatch("updateDraftAccount", this.$store.getters.fields)
        .then(response => {
          console.log(response);
          this.$store.commit("SET_VALIDATED_STEP", 4);
          this.$router.push("/complete/");
        });
    }
  }
};
</script>
