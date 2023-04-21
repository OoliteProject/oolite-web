
use strict;
use warnings;
use v5.10;

my @fns = sort glob('*.jpg *.JPG');
my $n = 1;
my @src;
for my $fn (@fns) {
    next
        if $fn =~ m/^\d{4}\.jpg$/;
    my $nfn = sprintf('%04d.jpg', $n++);
    push @src, $nfn . ': ' . $fn;
die;
    `mv ${fn} ${nfn}`;
}

if (@src) {die;
    my $src = join "\n", @src;
    `echo "${src}" >> source.txt`;
}
