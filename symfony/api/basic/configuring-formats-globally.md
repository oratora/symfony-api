# Changing API output format globally
 
```
# api/config/packages/api_platform.yaml
api_platform:
    formats:
        jsonld:   ['application/ld+json']
        jsonhal:  ['application/hal+json']
        jsonapi:  ['application/vnd.api+json']
        json:     ['application/json']
        xml:      ['application/xml', 'text/xml']
        yaml:     ['application/x-yaml']
        csv:      ['text/csv']
        html:     ['text/html']
```

see the full documentation for [Configuring Formats Globally](https://api-platform.com/docs/core/content-negotiation/#configuring-formats-globally)
