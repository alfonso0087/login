<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{

	public function index()
	{
		$data = [];
		helper(['form']);
		// $validation =  \Config\Services::validation();

		if ($this->request->getMethod() == 'post') {
			// Do validation
			$rules = [
				'email' => 'required|max_length[50]|valid_email',
				'password' => 'required|min_length[3]|max_length[255]|validateUser[email,password]',
			];

			// Make custom error message for validateUser method, also can use to make other custom message errors for others method ex:required,valid_email,etc
			$errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];


			if (!$this->validate($rules, $errors)) {
				// If not validated, return to views of register
				$data['validation'] = $this->validator;
			} else {
				// Store to database
				$userM = new UsersModel();

				$user = $userM->where('email', $this->request->getVar('email'))
					->first();

				$this->setUserSession($user);

				return redirect()->to('dashboard');
			}
		} else {
			// If request are not POST
		}

		echo view('templates/header', $data);
		echo view('login');
		echo view('templates/footer', $data);
	}

	private function setUserSession($user)
	{
		$data = [
			'id' => $user['id'],
			'firstname' => $user['firstname'],
			'lastname' => $user['lastname'],
			'email' => $user['email'],
			'isLoggedIn' => true
		];

		session()->set($data);
		return true;
	}

	public function register()
	{
		$data = [];
		helper(['form']);


		if ($this->request->getMethod() == 'post') {
			// Do validation
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|max_length[50]|valid_email|is_unique[users.email]',
				'password' => 'required|min_length[3]|max_length[255]',
				'password_confirm' => 'matches[password]'
			];


			if (!$this->validate($rules)) {
				// If not validated, return to views of register
				$data['validation'] = $this->validator;
			} else {
				// Store to database
				$userM = new UsersModel();

				$newData = [
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
				];
				$userM->save($newData);
				$session = session();
				$session->setFlashdata('Success', 'Successful Registration');
				return redirect()->to('/');
			}
		} else {
			// If request are not POST
		}

		echo view('templates/header', $data);
		echo view('register');
		echo view('templates/footer', $data);
	}


	public function profile()
	{
		$data = [];
		helper(['form']);
		$userM = new UsersModel();


		if ($this->request->getMethod() == 'post') {
			// Do validation
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
			];

			if ($this->request->getPost('password') != '') {
				$rules['password'] = 'required|min_length[3]|max_length[255]';
				$rules['password_confirm'] = 'matches[password]';
			}

			if (!$this->validate($rules)) {
				// If not validated, return to views of register
				$data['validation'] = $this->validator;
			} else {
				// Store to database

				$newData = [
					'id' => session()->get('id'),
					'firstname' => $this->request->getPost('firstname'),
					'lastname' => $this->request->getPost('lastname'),
				];

				if ($this->request->getPost('password') != '') {
					$newData['password'] = $this->request->getPost('password');
				}

				$userM->save($newData);

				session()->setFlashdata('Success', 'Successful Updated');
				return redirect()->to('/profile');
			}
		}

		$data['user'] = $userM->where('id', session()->get('id'))
			->first();

		echo view('templates/header', $data);
		echo view('profile');
		echo view('templates/footer', $data);
	}


	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}
	//--------------------------------------------------------------------

}
