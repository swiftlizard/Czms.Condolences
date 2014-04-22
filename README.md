# Setup Information

To setup this package you have to alter the default flow Routes.yaml by adding:
        -
          name: 'Condolences'
          uriPattern: '<CondolencesSubroutes>'
          subRoutes:
            CondolencesSubroutes:
              package: Czms.Condolences

on top of the file.

further more you have to run the following commands on CLI:
- ./flow doctrine:create
- ./flow admin:setup
- ./flow admin:createadminuser --username="<yourUsername>" --password="<yourPassword>"

After that you can Login and delete Spam post at:

YourUrl.com/Czms.Condolences/Login
