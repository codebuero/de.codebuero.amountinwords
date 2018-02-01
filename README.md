# de.codebuero.amountinwords

![Screenshot](/images/screenshot.png)

An extension for Drupal based CiviCRM. Adds a smarty function that calculates the outwritten
string to a given floating point value. Smarty (v2.0) function can then be used in templates.
Outwritten values of donated money are e.g. needed in German donation confirmations.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v5.4+
* Drupal (7.54)
* CiviCRM (4.6.33)

## Installation (Web UI)

Clone the extension in your civicrm extension folder. Make sure the files & folders have proper
read/write/execute rights. Afterwards install the extension in the extension menu in CiviCRM.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl de.codebuero.amountinwords@https://github.com/codebuero/de.codebuero.amountinwords/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/codebuero/de.codebuero.amountinwords.git
cv en amountinwords
```

## Usage

While editing a template the smarty function is invoked like this:

```

{amountinwords value=$donated_amount}

```

where ```$donated_amount``` is the value that needs to be transformed into a string.

## Known Issues

Tell me.


