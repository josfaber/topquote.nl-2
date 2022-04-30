FROM nginx:1.21.6-alpine

# ENV USER=www-data
# ENV UID=12345
# ENV GID=23456

RUN addgroup --gid 1000 mygroup
RUN adduser --system --no-create-home --disabled-password --uid 1000 --ingroup mygroup myuser

# RUN adduser \
#     --disabled-password \
#     --gecos "" \
#     --home "$(pwd)" \
#     --ingroup "$USER" \
#     --no-create-home \
#     --uid "$UID" \
#     "$USER"

RUN rm /etc/nginx/conf.d/default.conf

COPY ./dockerfiles/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./dockerfiles/nginx/default.conf /etc/nginx/templates/default.conf.template

# Tell docker that all future commands should run as the appuser user
USER myuser