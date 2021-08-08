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
              One Time Password
            </h3>
            <p class="text-sm text-gray-500 mb-4">
              4 digit OTP telah dikirim ke email Anda. Harap masukkan OTP pada
              kolom di bawah ini.
            </p>
            <input
              type="text"
              name="otp_code"
              placeholder=""
              v-model="otp_code"
              @change="$v.otp_code.$touch()"
              class="mb-4 text-center"
              style="font-size: 1.5rem; padding: 0.75rem 1rem"
            />
            <button
              @click="resendOtp"
              class="text-xs text-gray-400 hover:text-orange-500"
            >
              KIRIM ULANG OTP
            </button>
            <div v-if="resend_otp_message">
              <small>{{ resend_otp_message }}</small>
            </div>
            <div
              v-if="$v.otp_code.$error && !$v.otp_code.required"
              class="form-validation-error"
            >
              <small>OTP wajib diisi.</small>
            </div>
            <div v-if="validated_otp_message" class="form-validation-error">
              <small>{{ validated_otp_message }}</small>
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
      resend_otp_message: null
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
    async resendOtp() {
      this.isLoading = true;
      const resendOtpPayload = {
        otp_unique_id: this.otp_unique_id
      };
      await this.$store
        .dispatch("resendOtp", resendOtpPayload)
        .then(response => {
          //console.log(response);
          this.resend_otp_message = response.message;
          this.$store.commit("SET_OTP_UID", response.uniqueId);
          this.isLoading = false;
        });
    },
    async validateOtp() {
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
        } else {
          this.validated_otp_message = response.message;
          return;
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
  }
};
</script>
