FROM mhart/alpine-node:5

# add app user
RUN adduser -D -u 1000 appuser

RUN apk update \
    && apk add git python make g++ autoconf automake nasm libpng-dev libpng bash \
    && npm install -g bower gulp-cli

USER 1000

WORKDIR /app/htdocs

CMD ["gulp", "watch"]
