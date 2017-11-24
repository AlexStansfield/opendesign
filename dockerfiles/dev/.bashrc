# don't put duplicate lines or lines starting with space in the history.
HISTCONTROL=ignoreboth

# append to the history file, don't overwrite it
shopt -s histappend

# for setting history length see HISTSIZE and HISTFILESIZE in bash(1)
HISTSIZE=1000
HISTFILESIZE=2000

# aliases
alias ls='ls --color=auto'
alias ll='ls -alF'
alias la='ls -A'
alias l='ls -CF'
alias grep='grep --color=auto'
alias fgrep='fgrep --color=auto'
alias egrep='egrep --color=auto'

# bash completion
if ! shopt -oq posix; then
  if [ -f /usr/share/bash-completion/bash_completion ]; then
    . /usr/share/bash-completion/bash_completion
  elif [ -f /etc/bash_completion ]; then
    . /etc/bash_completion
  fi
fi

# trim long branch names
git_ps1_trim () {
    limit=24
    branch=$(__git_ps1)
    if [ ${#branch} -gt $limit ]; then
        echo $branch | cut -c 1-$((limit - 3)) | sed 's/.*/&...)/'
    else
        echo $branch
    fi
}

# fancy prompt
PS1='\u\[\033[0;31m\]@\[\033[0m\]opendesign-dev[\h]:\w\[\033[0;31m\]$(git_ps1_trim)\[\033[0m\]$ '
