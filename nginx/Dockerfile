FROM nginx:1.18-alpine

ENV USER=www-data
ENV UID=12345
ENV GID=23456

RUN adduser \
    --disabled-password \
    --gecos "" \
    --home "$(pwd)" \
    --ingroup "$USER" \
    --no-create-home \
    --uid "$UID" \
    "$USER"

RUN rm /etc/nginx/conf.d/default.conf

COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./default.conf /etc/nginx/templates/default.conf.template
