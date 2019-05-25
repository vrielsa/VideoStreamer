Vagrant.require_version ">= 2.2.4"

Vagrant.configure(2) do |config|
  config.vm.define "backendBox", primary: true do |backendBox|
    backendBox.vm.box = "generic/debian9"
    backendBox.vm.hostname = "api.videostreamer.local"
    backendBox.vm.network "private_network", ip: "192.168.55.2"
    backendBox.vm.provider "virtualbox" do |virtualBox|
      virtualBox.memory = 2048
      virtualBox.cpus = 2
    end
    backendBox.vm.provision "ansible" do |ansible|
      ansible.playbook = "./vagrant/ansible/playbook.yml"
    end
  end
end

load './vagrant/mounts'