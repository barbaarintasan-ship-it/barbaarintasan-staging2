import { useState } from "react";
import { Link, useLocation } from "wouter";
import { useParentAuth } from "@/contexts/ParentAuthContext";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Loader2, Eye, EyeOff, ExternalLink } from "lucide-react";
import { toast } from "sonner";
import { useTranslation } from "react-i18next";
import logoImage from "@assets/NEW_LOGO-BSU_1_1768990258338.png";

const COUNTRIES = [
  { value: "somalia", label: "🇸🇴 Soomaaliya" },
  { value: "djibouti", label: "🇩🇯 Jabuuti" },
  { value: "ethiopia", label: "🇪🇹 Itoobiya" },
  { value: "kenya", label: "🇰🇪 Kenya" },
  { value: "uganda", label: "🇺🇬 Uganda" },
  { value: "tanzania", label: "🇹🇿 Tanzania" },
  { value: "eritrea", label: "🇪🇷 Eritrea" },
  { value: "sudan", label: "🇸🇩 Suudaan" },
  { value: "south_sudan", label: "🇸🇸 Suudaan Koonfur" },
  { value: "egypt", label: "🇪🇬 Masar" },
  { value: "usa", label: "🇺🇸 Maraykanka (USA)" },
  { value: "canada", label: "🇨🇦 Kanada" },
  { value: "uk", label: "🇬🇧 Ingiriiska (UK)" },
  { value: "germany", label: "🇩🇪 Jarmalka" },
  { value: "france", label: "🇫🇷 Faransiiska" },
  { value: "italy", label: "🇮🇹 Talyaaniga" },
  { value: "spain", label: "🇪🇸 Isbaaniya" },
  { value: "netherlands", label: "🇳🇱 Holland" },
  { value: "belgium", label: "🇧🇪 Beljiyam" },
  { value: "switzerland", label: "🇨🇭 Swiiserlaand" },
  { value: "sweden", label: "🇸🇪 Iswiidhan" },
  { value: "norway", label: "🇳🇴 Noorweey" },
  { value: "denmark", label: "🇩🇰 Denmark" },
  { value: "finland", label: "🇫🇮 Finland" },
  { value: "austria", label: "🇦🇹 Osteeriya" },
  { value: "turkey", label: "🇹🇷 Turkiga" },
  { value: "saudi", label: "🇸🇦 Sacuudi Carabiya" },
  { value: "uae", label: "🇦🇪 Imaaraadka (UAE)" },
  { value: "qatar", label: "🇶🇦 Qadar" },
  { value: "kuwait", label: "🇰🇼 Kuwait" },
  { value: "bahrain", label: "🇧🇭 Baxrayn" },
  { value: "oman", label: "🇴🇲 Cumaan" },
  { value: "yemen", label: "🇾🇪 Yaman" },
  { value: "jordan", label: "🇯🇴 Urdun" },
  { value: "iraq", label: "🇮🇶 Ciraaq" },
  { value: "australia", label: "🇦🇺 Awsteeraaliya" },
  { value: "new_zealand", label: "🇳🇿 Niyuu Siilaan" },
  { value: "south_africa", label: "🇿🇦 Koonfur Afrika" },
  { value: "india", label: "🇮🇳 Hindiya" },
  { value: "pakistan", label: "🇵🇰 Bakistaan" },
  { value: "malaysia", label: "🇲🇾 Malaysia" },
  { value: "other", label: "🌍 Wadan Kale" },
];

const WORDPRESS_REGISTER_URL = "https://barbaarintasan.com/my-account/";

export default function Register() {
  const { t } = useTranslation();
  const [location, setLocation] = useLocation();
  const { registerWithEmail, loginWithEmail } = useParentAuth();

  const urlParams = new URLSearchParams(window.location.search);
  const redirectUrl = urlParams.get("redirect") || "/";
  const returnUrl = urlParams.get("returnUrl");
  const messageType = urlParams.get("message");

  const [isLogin, setIsLogin] = useState(location.includes("/login"));
  const [isLoading, setIsLoading] = useState(false);
  const [showPassword, setShowPassword] = useState(false);
  const [showConfirmPassword, setShowConfirmPassword] = useState(false);

  const [formData, setFormData] = useState({
    name: "",
    email: "",
    password: "",
    confirmPassword: "",
    phone: "",
    country: "",
  });

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      if (isLogin) {
        await loginWithEmail(formData.email, formData.password);
        toast.success(t("auth.loginSuccess"));
      } else {
        if (!formData.name || !formData.phone || !formData.country) {
          toast.error("Fadlan buuxi dhammaan fields-ka khasabka ah");
          setIsLoading(false);
          return;
        }
        if (formData.password !== formData.confirmPassword) {
          toast.error("Password-yada ma isku mid ahiin");
          setIsLoading(false);
          return;
        }
        await registerWithEmail(formData.email, formData.password, formData.name, formData.phone, formData.country, "", false);
        toast.success(t("auth.registerSuccess"));
        await loginWithEmail(formData.email, formData.password);
        toast.success(t("auth.loginSuccess"));
      }

      if (returnUrl && (returnUrl.startsWith("https://barbaarintasan.com") || returnUrl.startsWith("https://www.barbaarintasan.com"))) {
        window.location.href = returnUrl;
      } else {
        setLocation("/");
      }
    } catch (err) {
      console.error(err);
      toast.error("Waxaa dhacay qalad, fadlan isku day mar kale");
    } finally {
      setIsLoading(false);
    }
  };

  const handleWordPressRegister = () => {
    window.open(WORDPRESS_REGISTER_URL, "_blank");
  };

  return (
    <div className="min-h-screen bg-white flex flex-col">
      <div className="flex-1 flex flex-col items-center justify-center px-4 py-8">
        <div className="w-full max-w-[400px]">
          <div className="text-center mb-8">
            <img src={logoImage} alt="Barbaarintasan" className="w-16 h-16 rounded-2xl mx-auto mb-4" />
            <h1 className="text-2xl font-bold text-gray-900">{isLogin ? "Soo Gal" : "Sameyso Akoon"}</h1>
          </div>

          {!isLogin && (
            <div className="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-6">
              <p className="text-gray-700 text-sm leading-relaxed mb-4">
                Si aad akoon u sameyso, fadlan booqo websaydkeena barbaarintasan.com oo halkaas iska diiwaangeli. Ka dib marka aad is diiwaangeliso, soo noqo halkan oo ku gal email-kaaga iyo password-kaaga.
              </p>
              <Button
                onClick={handleWordPressRegister}
                className="w-full h-12 text-base font-bold bg-blue-600 hover:bg-blue-700 rounded-lg flex items-center justify-center gap-2"
              >
                <ExternalLink className="w-5 h-5" />
                Iska Diiwaangeli barbaarintasan.com
              </Button>
            </div>
          )}

          <form onSubmit={handleSubmit} className="space-y-4">
            {!isLogin && (
              <>
                <Input
                  type="text"
                  value={formData.name}
                  onChange={(e) => setFormData({ ...formData, name: e.target.value })}
                  placeholder="Magacaaga oo dhamaystiran"
                  required
                  className="h-12 text-base border-2 border-gray-300 rounded-lg px-4 placeholder:text-gray-400"
                />
                <Input
                  type="tel"
                  value={formData.phone}
                  onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
                  placeholder="Taleefankaaga (+252...)"
                  required
                  className="h-12 text-base border-2 border-gray-300 rounded-lg px-4 placeholder:text-gray-400"
                />
                <Select
                  value={formData.country}
                  onValueChange={(value) => setFormData({ ...formData, country: value })}
                >
                  <SelectTrigger className="h-12 text-base border-2 border-gray-300 rounded-lg px-4">
                    <SelectValue placeholder="Wadanka" />
                  </SelectTrigger>
                  <SelectContent className="max-h-[300px] overflow-y-auto">
                    {COUNTRIES.map((country) => (
                      <SelectItem key={country.value} value={country.value}>
                        {country.label}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                <div className="grid grid-cols-2 gap-3">
                  <div className="relative">
                    <Input
                      type={showPassword ? "text" : "password"}
                      value={formData.password}
                      onChange={(e) => setFormData({ ...formData, password: e.target.value })}
                      placeholder="Password"
                      required
                      minLength={6}
                      className="h-12 text-base border-2 border-gray-300 rounded-lg px-4 pr-10 placeholder:text-gray-400"
                    />
                    <button
                      type="button"
                      onClick={() => setShowPassword(!showPassword)}
                      className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                    >
                      {showPassword ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
                    </button>
                  </div>
                  <div className="relative">
                    <Input
                      type={showConfirmPassword ? "text" : "password"}
                      value={formData.confirmPassword}
                      onChange={(e) => setFormData({ ...formData, confirmPassword: e.target.value })}
                      placeholder="Xaqiiji Password"
                      required
                      minLength={6}
                      className="h-12 text-base border-2 border-gray-300 rounded-lg px-4 pr-10 placeholder:text-gray-400"
                    />
                    <button
                      type="button"
                      onClick={() => setShowConfirmPassword(!showConfirmPassword)}
                      className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                    >
                      {showConfirmPassword ? <EyeOff className="w-4 h-4" /> : <Eye className="w-4 h-4" />}
                    </button>
                  </div>
                </div>
              </>
            )}

            <Input
              type="email"
              value={formData.email}
              onChange={(e) => setFormData({ ...formData, email: e.target.value })}
              placeholder="Email-kaaga"
              required
              className="h-12 text-base border-2 border-gray-300 rounded-lg px-4 placeholder:text-gray-400"
            />
            {isLogin && (
              <Input
                type={showPassword ? "text" : "password"}
                value={formData.password}
                onChange={(e) => setFormData({ ...formData, password: e.target.value })}
                placeholder="Password"
                required
                className="h-12 text-base border-2 border-gray-300 rounded-lg px-4 placeholder:text-gray-400"
              />
            )}

            <Button type="submit" className="w-full h-12">
              {isLoading ? <Loader2 className="w-5 h-5 animate-spin" /> : isLogin ? "Soo Gal" : "Is Diiwaan Geli"}
            </Button>
          </form>

          <div className="mt-8 pt-6 border-t border-gray-200 text-center">
            {isLogin ? (
              <p className="text-gray-600 text-sm">
                Akoon ma haysatid?{" "}
                <button
                  onClick={() => { setIsLogin(false); setLocation("/register"); }}
                  className="text-blue-600 font-semibold hover:underline"
                >
                  Is Diiwaan Geli
                </button>
              </p>
            ) : (
              <p className="text-gray-600 text-sm">
                Hadaad Akoon horay u lahayd?{" "}
                <button
                  onClick={() => { setIsLogin(true); setLocation("/login"); }}
                  className="text-blue-600 font-semibold hover:underline"
                >
                  Soo Gal
                </button>
              </p>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}