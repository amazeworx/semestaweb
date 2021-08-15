<template>
  <div>
    <div class="bg-white shadow relative">
      <loading
        :active.sync="isLoading"
        :can-cancel="true"
        :is-full-page="true"
        color="#007BFF"
      />
      <div
        class="flex flex-wrap px-4 py-6 lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full">
          <div class="max-w-sm mx-auto text-center">
            <h3 class="w-full text-2xl font-bold mb-2">
              Verifikasi alamat email Anda
            </h3>
            <p class="text-sm text-gray-500 mb-4">
              Masukkan 6 digit kode yang telah dikirimkan ke email Anda pada
              kolom di bawah ini. Jika Anda tidak menerimanya, harap periksa
              folder Spam/Junk.
            </p>
            <input
              type="text"
              name="otp_code"
              placeholder="Kode Verifikasi"
              v-model="otp_code"
              @change="$v.otp_code.$touch()"
              class="mb-4 text-center font-bold"
              style="font-size: 1.5rem; padding: 0.75rem 1rem"
            />
            <div v-if="resend_otp_message" class="mb-4 text-green-500">
              <small>{{ resend_otp_message }}</small>
            </div>
            <div
              v-if="$v.otp_code.$error && !$v.otp_code.required"
              class="form-validation-error"
            >
              <small>OTP wajib diisi.</small>
            </div>
            <div
              v-if="validated_otp_message"
              class="form-validation-error mb-4"
            >
              <small>{{ validated_otp_message }}</small>
            </div>
            <button
              v-if="!redirectTrigger"
              @click="resendOtp"
              class="text-xs text-gray-400 hover:text-orange-500"
            >
              KIRIM KODE BARU
            </button>
            <div v-if="redirectTrigger" class="mb-4">
              <small>Mengalihkan dalam {{ redirectCount }} detik...</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Buttons -->
    <div class="flex gap-4 mt-8 justify-center">
      <button
        @click="navigateNext()"
        type="button"
        class="
          px-4
          py-2
          border
          rounded
          text-sm
          font-bold
          uppercase
          bg-orange
          border-orange
          text-white
          hover:bg-orange-light
          hover:border-orange-light
          focus:outline-none
          transition
          ease-in-out
          duration-150
        "
      >
        Submit ⟶
      </button>
    </div>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
import { mutateFields } from "../../helpers/helpers.js";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  components: { Loading },
  data() {
    return {
      isLoading: false,
      otp_code: "",
      validated_otp_message: null,
      resend_otp_message: null,
      redirectCount: 5,
      redirectTrigger: false
    };
  },
  mounted() {
    this.$store.commit("SET_STEP", "0");
    const otp_sent = this.$store.getters.otp_sent;
    if (!otp_sent) {
      this.$router.push("/");
    }
  },
  computed: {
    ...mutateFields({
      fields: [
        "has_bca",
        "bca_account_number",
        "bca_account_name",
        "bank_2_name",
        "bank_2_accnumber",
        "bank_2_accname",
        "lead_id",
        "account_id"
      ],
      base: "fields",
      mutation: "UPDATE_FIELD"
    })
  },
  validations: {
    otp_code: {
      required
    }
  },
  methods: {
    async requestOtp() {
      const requestOtpPayload = {
        email: this.$store.getters.fields.email,
        lead_id: this.$store.getters.fields.lead_id
      };
      await this.$store
        .dispatch("requestOtp", requestOtpPayload)
        .then(response => {
          //console.log(response);
          this.isLoading = false;
          //this.otp_unique_id = response.uniqueId;
          this.$store.commit("SET_OTP_SENT", true);
          this.$store.commit("SET_OTP_UID", response.uniqueId);
          //console.log(this.otp_unique_id);
          //this.$router.push("/otp/");
        });
    },
    async resendOtp() {
      this.isLoading = true;
      this.resend_otp_message = null;
      this.validated_otp_message = null;
      const resendOtpPayload = {
        otp_unique_id: this.$store.getters.otp_unique_id
      };
      if (this.$store.getters.otp_unique_id) {
        await this.$store
          .dispatch("resendOtp", resendOtpPayload)
          .then(response => {
            //console.log(response);
            if (response.code == 201) {
              this.resend_otp_message =
                "Kode baru telah dikirimkan ke email Anda";
              this.$store.commit("SET_OTP_UID", response.uniqueId);
              this.isLoading = false;
            } else {
              this.resend_otp_message = response.message;
              this.$store.commit("SET_OTP_UID", response.uniqueId);
              this.isLoading = false;
            }
          });
      } else {
        this.isLoading = false;
        this.validated_otp_message =
          "Gagal mengirim kode baru. Harap mengulang kembali";
        this.redirectBack();
      }
    },
    redirectBack() {
      this.redirectTrigger = true;
      this.redirectCountDown();
      setTimeout(() => {
        this.$router.push("/");
      }, 5000);
    },
    redirectCountDown() {
      if (this.redirectCount > 0) {
        setTimeout(() => {
          this.redirectCount -= 1;
          this.redirectCountDown();
        }, 1000);
      }
    },
    async validateOtp() {
      this.resend_otp_message = null;
      this.validated_otp_message = null;
      const otpPayload = {
        otp_code: this.otp_code,
        otp_unique_id: this.$store.getters.otp_unique_id
      };
      await this.$store.dispatch("validateOtp", otpPayload).then(response => {
        //console.log(response);
        this.isLoading = false;
        if (response.code == 200) {
          this.createAccount().then(() => {
            this.$router.push("/step-1/");
          });
        } else if (response.code == 404) {
          this.$store.commit("SET_OTP_RESENDID", response.resendId);
          this.validated_otp_message = "Kode Expired/Timeout";
        } else if (response.code == 400) {
          this.$store.commit("SET_OTP_RESENDID", response.resendId);
          this.validated_otp_message = "Kode Invalid";
        } else if (response.code == 413) {
          this.$store.commit("SET_OTP_RESENDID", response.resendId);
          this.validated_otp_message =
            "Anda sudah 3x salah memasukkan kode. Harap mengulang kembali.";
          this.redirectBack();
        } else {
          this.$store.commit("SET_OTP_RESENDID", response.resendId);
          this.validated_otp_message = response.message;
        }
      });
    },
    async createAccount() {
      if (this.has_bca) {
        this.bank_2_name = "BANK CENTRAL ASIA";
        this.bank_2_accname = this.bca_account_name;
        this.bank_2_accnumber = this.bank_account_number;
      }
      const createDraftPayload = {
        has_bca: this.has_bca,
        bca_account_number: this.bca_account_number,
        bca_account_name: this.bca_account_name,
        email: this.email,
        lead_id: this.lead_id
      };
      await this.$store
        .dispatch("createDraftAccount", createDraftPayload)
        .then(response => {
          //console.log(response);
          this.isLoading = false;
          this.account_id = response.id;
        });
    },
    async navigateNext() {
      this.resend_otp_message = "";
      this.$v.$touch();
      if (this.$v.$error) return;
      //console.log(this.otp_code);
      this.isLoading = true;
      this.validateOtp();
    }
  },
  watch: {
    timerCount: {
      handler(value) {
        if (value > 0) {
          setTimeout(() => {
            this.timerCount--;
          }, 1000);
        }
      },
      immediate: true // This ensures the watcher is triggered upon creation
    }
  }
};
</script>
