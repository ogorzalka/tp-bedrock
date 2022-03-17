#
# This is an example VCL file for Varnish.
#
# It does not do anything by default, delegating control to the
# builtin VCL. The builtin VCL is called when there is no explicit
# return statement.
#
# See the VCL chapters in the Users Guide at https://www.varnish-cache.org/docs/
# and https://www.varnish-cache.org/trac/wiki/VCLExamples for more examples.

# Marker to tell the VCL compiler that this VCL has been adapted to the
# new 4.0 format.
vcl 4.0;

# Default backend definition. Set this to point to your content server.
backend default {
    .host = "httpd";
    .port = "80";
}

sub vcl_recv {
  # Set the X-Forwarded-For header so the backend can see the original
  # IP address. If one is already set by an upstream proxy, we'll just re-use that.

  #return(pass);

  if (req.method == "PURGE") {
     return (purge);
  }

  if (req.method == "XCGFULLBAN") {
     ban("req.http.host ~ .*");
     return (synth(200, "Full cache cleared"));
  }

  if (req.http.X-Requested-With == "XMLHttpRequest") {
     return(pass);
  }

  if (req.http.Authorization || req.method == "POST") {
     return (pass);
  }

  if (req.method != "GET" && req.method != "HEAD") {
     return (pass);
  }

  if (req.url ~ "(wp-admin|post\.php|edit\.php|wp-login|wp-json)") {
     return(pass);
  }

  if (req.url ~ "/wp-cron.php" || req.url ~ "preview=true") {
     return (pass);
  }

  if ((req.http.host ~ "my_domain.com" && req.url ~ "^some_specific_filename\.(css|js)")) {
     return (pass);
  }

  set req.http.Cookie = regsuball(req.http.Cookie, "has_js=[^;]+(; )?", "");

  # Remove the wp-settings-1 cookie
  set req.http.Cookie = regsuball(req.http.Cookie, "wp-settings-1=[^;]+(; )?", "");

  # Remove the wp-settings-time-1 cookie
  set req.http.Cookie = regsuball(req.http.Cookie, "wp-settings-time-1=[^;]+(; )?", "");

  # Remove the wp test cookie
  set req.http.Cookie = regsuball(req.http.Cookie, "wordpress_test_cookie=[^;]+(; )?", "");

  # Remove the PHPSESSID in members area cookie
  set req.http.Cookie = regsuball(req.http.Cookie, "PHPSESSID=[^;]+(; )?", "");

  unset req.http.Cookie;
}

sub vcl_purge {
    set req.method = "GET";
    set req.http.X-Purger = "Purged";

    #return (synth(200, "Purged"));
    return (restart);
}

sub vcl_backend_response {
    set beresp.grace = 12h;
    set beresp.ttl = 12h;
}

sub vcl_deliver {
    # Happens when we have all the pieces we need, and are about to send the
    # response to the client.
    #
    # You can do accounting or modifying the final object here.
}