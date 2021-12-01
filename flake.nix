{
  description = "Gravatar URL builder which is most commonly called a Gravatar library";

  inputs = {
    nixpkgs.url = "nixpkgs/nixos-unstable";
    flake-utils.url = "github:numtide/flake-utils";
  };

  outputs = { self, nixpkgs, flake-utils, ... }:
    flake-utils.lib.eachDefaultSystem (system:
      let
        pkgs = import nixpkgs { inherit system; };
      in
      {
        devShell = pkgs.mkShell {
          buildInputs = with pkgs;
            [
              git
              gnumake
              (php.withExtensions ({ enabled, all }: enabled ++ [ all.xdebug ]))
              php.packages.composer
            ];
        };
      });
}
