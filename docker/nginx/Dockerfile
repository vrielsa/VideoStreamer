FROM nginx:alpine

RUN apk --no-cache add shadow bash vim && \
    groupadd www-data && \
    adduser -S www-data && \
    usermod -a -G www-data www-data

WORKDIR /www-data

CMD ["nginx"]

EXPOSE 80 443