# Opencart 3 SanalPOS PRO Ödeme Modülü

![Desteklenen PHP Sürümü](https://img.shields.io/badge/PHP-%3E%3D7.4-purple)
![Desteklenen OpenCart Sürümü](https://img.shields.io/badge/OpenCart-%3E%3D3.0.3-blue)


> ⚠️ **Önemli Bilgilendirme:** Bu eklenti **PHP 7.4+** ve **OpenCart 3.0.3+** sürümlerinde çalışmaktadır.  
> Daha düşük bir PHP veya OpenCart sürümü kullanıyorsanız **çalışmayacaktır**.
> Eğer Opencart 4 kullanıyorsanız **[bu linkteki](https://github.com/eticsoft/sanalpospro-opencart4-module)** eklentimizi kurarak devam ediniz.

Opencart, e-ticaret siteleri için popüler bir açık kaynaklı platformdur. SanalPOS PRO ödeme modülü ile müşterilerinize güvenli ödeme seçenekleri sunabilirsiniz. 
Aşağıda, SanalPOS PRO modül kurulum sürecini adım adım anlatan bir kılavuz bulunmaktadır.

## EKLENTİ İNDİRME

[Buraya](https://github.com/eticsoft/sanalpospro-opencart3-module/releases) tıklayıp açılan sayfada en son sürümü seçin ardından sanalpospro.zip adlı dosyayı indirebilirsiniz.

![Opencart eklenti indirme](https://cdn.paythor.com/1/104/installation/3/install.png)

## EKLENTİ YÜKLEME

1. Opencart yönetici panelinize giriş yapın.
2. Sol menüden Eklentiler > Eklenti Yükle sekmesine tıklayın.
3. Açılan sayfada Yükleme(Upload) butonuna tıklayın.
4. Açılan pencerede, bilgisayarınıza indirdiğiniz SanalPOS PRO Modülü ZIP dosyanızı seçin ve yüklemenin tamamlanmasını bekleyin.

![Opencart kurulum adım 1](https://cdn.paythor.com/1/104/installation/3/1.png)

6. İşlem tamamlandıktan sonra sol menüden Eklentiler > Eklentiler sekmesine tıklayın.
7. Açılan sayfada eklenti türünü ödeme metodları (Payments) olarak seçin.
8. Aşağıdaki listede SanalPOS PRO modülünü bulun ve yanındaki (+) butonuna tıklayıp yükleme işlemini tamamlayın.

![Opencart kurulum adım 2](https://cdn.paythor.com/1/104/installation/3/2.png)


### FTP Üzerinden SanalPOS PRO Modülü Yükleme (Alternatif Yöntem)

Eğer yönetici paneli üzerinden yükleme başarısız olursa, modülü manuel olarak yüklemek için aşağıdaki adımları takip edin:

1. FileZilla veya benzeri bir FTP istemcisi kullanarak sunucunuza bağlanın.
2. Opencart sitenizin olduğu dizine gidiniz.
3. ZIP dosyanızı bilgisayarınıza çıkarın.
4. Çıkarılan `upload` klasörünün içerisindeki `admin` ve `catalog` klasörlerini dizinine yükleyin.

![FTP kurulum görseli](https://cdn.paythor.com/1/104/installation/3/ftp.png)

5. Yönetici paneline giriş yaparak sol menüden **Eklentiler >  Eklentiler** sekmesine tıklayın.
6. SanalPOS PRO modülünü listeden bulun ve **Etkinleştir** butonuna tıklayın.


## AYARLARIN YAPILANDIRILMASI

1. Yönetici panelinden Modüller > Modül Yöneticisi sekmesine gidin.
2. SanalPOS PRO modülünün yanındaki Yapılandır butonuna tıklayın.
3. Modülü kullanabilmek için açılan modül arayüzünde Kayıt Olun butonuna tıklayın ve gerekli bilgileri girerek hesap oluşturun.

![Giriş Ekranı](https://cdn.paythor.com/1/confsteps/login.png)

![Kayıt Ekranı](https://cdn.paythor.com/1/confsteps/register.png)

4. Oluşturduğunuz kullanıcı bilgileri girerek giriş yap butonuna tıklayın.
5. E-posta adresinize gelen doğrulama kodunu giriniz.
6. Doğrula butonuna basınız.

![Doğrulama Ekranı](https://cdn.paythor.com/1/confsteps/verification.png)

7. Açılan arayüzden Ödeme Yöntemi sekmesine tıklayın.
8. Kullanmak istediğiniz ödeme kuruluşu veya bankayı seçip **installable** butonuna tıklayınız ardından ödeme kuruluşu veya bankanız tarafından sizlere iletilen bilgileri girin.

![Ödeme Yöntemi Ayarları](https://cdn.paythor.com/1/confsteps/gateway.png)

9. Yapılandırmaları girdikten sonra **install** butonuna basın.

![Ödeme Yöntemi Yapılandırmaları](https://cdn.paythor.com/1/confsteps/gatewayconfig.png)

Test siparişi oluşturarak SanalPosPRO ödeme işleminin sorunsuz çalıştığını doğrulayın.

## TEST AŞAMASI

1. Ödeme Yöntemi (GATEWAY) butonuna tıklayın.
2. Test Modu başlığının altında yer alan seçilebilir alanı Test Modu olarak seçin ve Kaydet butonuna tıklayın.
3. Sepetinize bir ürün ekleyin ve ödeme adımında SanalPosPRO ile Öde seçeneğini seçin.
4. Açılan Pop-up ödeme sayfası üzerinde test kart bilgilerini giriş yapın ve ödemeyi tamamlayın.

![Ödeme Ekranı](https://cdn.paythor.com/1/confsteps/paymentpage.png)

Bu işlemlerden sonra problem yaşanır ise **DESTEK** (**SUPPORT**) butonuna tıklayarak destek ekibi ile iletişime geçebilirsiniz.
