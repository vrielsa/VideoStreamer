FROM nginx:alpine

WORKDIR /www-data

ENV CERT_PASS={$CERT_PASS}

RUN apk --no-cache add shadow bash vim openssl && \
    groupadd www-data && \
    adduser -S www-data && \
    usermod -a -G www-data www-data && \
    mkdir -p jwt && \
    openssl genrsa -out /www-data/jwt/private.pem -passout pass:{$CERT_PASS} -aes256 4096 && \
    openssl rsa -pubout -in /www-data/jwt/private.pem -out /www=data/jwt/public.pem -passin pass:{$CERT_PASS}

CMD ["nginx"]

EXPOSE 80 443