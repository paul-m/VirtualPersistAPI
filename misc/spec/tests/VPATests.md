VirtualPersistAPI Testing Notes
===

Some Tests We'll Need To Create:
---

Given positive authentication...

GET `[endpoint]/` should return 404.

GET `[endpoint]/[uuid]` should return 404.

GET `[endpoint]/[uuid]/[nonexistant category]` should return 404.

GET `[endpoint]/[uuid]/[nonexistant category]/[nonexistent key]` should return 404.

