### Setup and up
* Install `docker`
* Run `make up`
* Open in your browser `fake-payment.pekarium`

### Up
Run `make up`

### Down
Run `make down`

### How to use
##### New Payment (step 1)
- url: http://fake-payment.pekarium/new
- method: POST
- arguments:
  - amount
    - type: float
    - required: true
  - currency_code
    - type: string
    - required: true
    - choices:
      - USD
      - EUR
      - UAH
  - callback_url
    - type: string
    - required: true
  - redirect_url
    - type: string
    - required: true
- response:
  - format: json
  - success:
    - http code: 200
    - data:
      - url
        - type: string
  - error:
    - http code: 400
    - data:
      - error
        - type: array
        - data:
          - code
            - type: string
            - description: error code `App\Dictionary\ErrorCodeDictionary`
          - data
            - type: array
            - description: error debug data

##### Confirm Payment (step 4)
- cards:
  - success: `1111 1111 1111 1111`
  - fail: `0000 0000 0000 0000`
- other data is not necessary
