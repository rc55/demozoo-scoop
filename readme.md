- Create folders production-lists, production-instances, apps, bucket.
- Extract production-lists.zip into the production-lists folder to save hammering Demozoo

Don't run any of this code yet!

* get-production-lists - Downloads the paginated json from Demozoo into seperate files.
* get-production-instances - Iterates over the lists and downloads production json into files.
* generate-apps - Iterates over production info json files and downloads referenced files.
* generate-manifests - Iterates over production info json, checksums downloads and generates scoop json files.
