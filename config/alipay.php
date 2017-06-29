<?php
return [
	# 微信的appid
	'app_id'=>'2015082076224046',
	# 商户私钥，您的原始格式RSA私钥
	'merchant_private_key'=>'MIICXAIBAAKBgQDpeMhKjTBkkDqbuoME5DdsyEc530yYL/yC9FNjx8YtiQlv89sKcsrhlCLS/jwy97jzg+uDHlGcDn7Lbt0Ky+1AtCMkf8o67pqNvORXfxSrG/skLGJIVB2ehlUKK1nVV6FvucHZAasdadasubWr+CF5H2YKUlaDLnMNaltf5QIDAQABAoGBANqWgfgCzq8otia9bhOzVA0eSkltvrmyG9nDxRtjnDFf3x0ZFBhpN3gSCLTA4T3a3yfneCXvyfqxO5dd+cg0+6/RsKHTHiAmsrYyWC8UZkVvSzSz+UmoqxixzEgsEyt1DXBSC3+bGzIWDjktHyLDjlbN0Nl24TMPKnJkqzEUK1ABAkEA/IYONWmcK+3mNaljqDTAKmWmO29TYOB0A0xeOcuwdzSIWzVn0jFVUwNDU/PRc1yfK/ra8m/v6HjkRA+SzEeMAQJBAOyvlZWbISdnVIKeUsqQuOzmbYbzdYLxIHYnjMv++EEg2hqfT2Zv6ISbSODWFbayDrheLW2ZE52U72NKl9I3I+UCQFS+A/ymsVMIpe2yJ5BmC2ru68ccR+XFzQjiUuigU1rdlTjOhkXCanjOKoT82HgXSA8xQtKDAAaKs0en1kKZbAECQANQulGsKJy6r85clWBNAqoe2C3pvx2kbwX4q9o3qhaPdT6mOKCAtMsWucCcfxVeDSK7/vroCARPD8NeSh4hs5kCQAg4Mbvv9I229ggUpQg/CE5vd3FzZ5nrUXMftCiKCu37fDCFZ8TeFqwyEThaM58WaGsDsHEKQ0TP0KD1mmEtE3c=',
	# 异步通知地址
	'notify_url'=>'http://axxxxxx.com/Home/Wechat/alipaycallback.html',
	# 同步跳转
	'return_url'=>"http://axxxxxx.caocaohao.com/Home/Wechat/AlipayUrl.html",
	# 编码格式
	'charset'=>'UTF-8',
	# 签名方式
	'sign_type' => 'RSA',
	# 支付宝网关
	'gatewayUrl'=>"https://openapi.alipay.com/gateway.do",
	# 支付宝私钥文件
	'rsa_private_key' => ROOT_PATH.'pem/siyao.txt',
	# 支付宝公钥
	'ali_public_key' => "MIGfMA0GCSqGSIb3DQEwqewqe2QWBiQKBgQDDI6d306Q8fIfCOaTXyiUeJHkrIvYISRcc73s3vF1ZT7XN8RNPwJxo8pWaJMmvyTn9N4HQ632qJBVHf8sxHi/fEsraprwCtzvzQETrNRwVxLO5jVmRGi60j8Ue1efIlzPXV9je9mkjzOmdssymZkh2QhUrCmZYI/FCEa3/cNMW0QIDAQAB"

];