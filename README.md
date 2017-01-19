# unit6/docusign

This is an (unofficial) DocuSign&reg; client library in PHP to help you get started with the [DocuSign&reg; eSignature API](https://www.docusign.com/developer-center/api-overview).


## Prerequisites

- A free DocuSign development account from their [Developer Center](https://www.docusign.com/developer-center).
- A DocuSign Integrator Key (available in the Developer Center).


## Environment Variables

Write your developer credentials to an environmental file, for example:

```bash
echo "export DOCUSIGN_INTEGRATOR_KEY='EXAM-00000000-0000-0000-0000-000000000000'" >> docusign.env
echo "export DOCUSIGN_EMAIL='foo@example.org'" >> docusign.env
echo "export DOCUSIGN_PASSWORD='password'" >> docusign.env
echo "export DOCUSIGN_ACCOUNT_ID='000000'" >> docusign.env
```

Update the development environment 
	
	source ./docusign.env

## System Requirements

- [PHP](http://www.php.net/) > 5.2.x
- PHP [cURL](http://www.php.net/curl) Extension
- PHP [JSON](http://www.php.net/json) Extension

This client library was tested with PHP 5.6.2 on Mac OS X.


## Examples

Create and send an envelope with a single document for signing.

```
$ php example/sendEnvelope.php
envelopeId                              status      statusDateTime
----------                              ------      --------------
df46eb99-35e0-44bc-8ee1-070664dd8a1e    sent        2015-04-14T14:44:47.3570000Z
```

Retrieve the sent envelope for embedded signing using the URL. Keeping in mind the URL can only be retrieved for recipients who have recieved the envelope, as defined by a `status` of `sent` and are next to sign, as defined by the `routingOrder`.

```
$ php example/getEnvelope.php
recipientIdGuid                         routingOrder    status      URL
---------------                         ------------    ------      ---
0c46455d-0703-40ac-8e2e-e794c1ba00ba    1               sent        https://demo.docusign.net/Signing/startinsession.aspx?t=7c6b1cc7-c047-4729-8b91-f88a1bd10c2d
2556cfb4-2f9e-463e-8677-e8b40866132b    2               created
67c98f05-ba2c-4e7b-9ff7-9673a6e2b2e6    2               created

```

Retrieve a list of envelopes that are out for signing.

```
$ php example/getOutEnvelopes.php
envelopeId                              sentDateTime                    status
----------                              ------------                    ------
5fa3102a-723e-4e39-bc04-a78407108d22    2015-03-17T15:29:18.3570000Z    sent
60ac6d32-5795-4f4f-95cf-7b7ede111642    2015-04-02T11:15:09.8730000Z    sent
2987b787-66c6-48aa-9a84-4fb302feae4b    2015-04-14T14:44:47.3570000Z    sent
```

Void (delete) a specific envelope with a reason.

```
$ php example/voidEnvelope.php  --id="60ac6d32-5795-4f4f-95cf-7b7ede111642" --reason="It was only a test!"
Envelope to void:
    envelopeId: 60ac6d32-5795-4f4f-95cf-7b7ede111642
    voidReason: It was only a test!

Outcome
-------
OK
```



## Documentation

This library is based on the [DocuSign REST API Guide (v2)](https://www.docusign.com/sites/default/files/REST_API_Guide_v2.pdf) and the
[eSignature REST API](https://docs.docusign.com/esign/) documentation.


## TODO

- Achieve feature completeness (see [COVERAGE.txt](./COVERAGE.txt)).
- Write tests.
- Publish to [Packagist](https://packagist.org/) so you can install using [Composer](https://getcomposer.org/).


## Acknowledgements

Inspired by these libraries:

- [mrferos/docusign-zf2-lib](https://github.com/mrferos/docusign-zf2-lib)
- [mrferos/docusign-php-lib](https://github.com/mrferos/docusign-php-lib)
- [docusign/eSignPHPLib](https://github.com/docusign/eSignPHPLib)
- [docusign/DocuSign-PHP-Client](https://github.com/docusign/DocuSign-PHP-Client)



## License

MIT, see LICENSE.


[2]: https://packagist.org/packages/unit6/docusign
[5]: https://github.com/mrferos/docusign-php-lib