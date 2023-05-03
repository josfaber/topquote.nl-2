FROM node:18-slim

RUN apt-get update && apt-get install -y \
    build-essential \
    python3 \
    # python3-pip \
    # python3-dev \
    python3-setuptools \
    # python3-wheel \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /project

COPY package* .

RUN npm install 

CMD ["tail", "-f", "/dev/null"]