<?php

namespace App\Controller;

use App\Entity\Member;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/members')]
class MemberController extends AbstractController
{
    // GET ALL
    #[Route('', name: 'members_index', methods: ['GET'])]
    public function index(MemberRepository $memberRepository): JsonResponse
    {
        $members = $memberRepository->findAll();
        return $this->json($members, 200, [], ['groups' => 'member:read']);
    }

    // GET ONE
    #[Route('/{id}', name: 'members_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Member $member): JsonResponse
    {
        return $this->json($member, 200, [], ['groups' => 'member:read']);
    }

    // CREATE avec upload
    #[Route('', name: 'members_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $name = $request->request->get('name');
        /** @var UploadedFile $imageFile */
        $imageFile = $request->files->get('image');

        if (!$name) return $this->json(['error' => 'Missing name'], 400);

        $member = new Member();
        $member->setName($name);
        $member->setCreatedAt(new \DateTimeImmutable());

        // Upload fichier
        if ($imageFile) {
            $uploadsDir = $this->getParameter('uploads_directory'); // à configurer dans services.yaml
            $filename = uniqid() . '.' . $imageFile->guessExtension();
            try {
                $imageFile->move($uploadsDir, $filename);
            } catch (FileException $e) {
                return $this->json(['error' => 'Upload failed'], 500);
            }
            $member->setImage('/uploads/' . $filename);
        }

        $em->persist($member);
        $em->flush();

        return $this->json($member, 201, [], ['groups' => 'member:read']);
    }

    // UPDATE avec upload
    #[Route('/{id}', name: 'members_update', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function update(Request $request, Member $member, EntityManagerInterface $em): JsonResponse
    {
        $name = $request->request->get('name');
        /** @var UploadedFile $imageFile */
        $imageFile = $request->files->get('image');

        if ($name) $member->setName($name);

        if ($imageFile) {
            $uploadsDir = $this->getParameter('uploads_directory');
            $filename = uniqid() . '.' . $imageFile->guessExtension();
            try {
                $imageFile->move($uploadsDir, $filename);
            } catch (FileException $e) {
                return $this->json(['error' => 'Upload failed'], 500);
            }
            $member->setImage('/uploads/' . $filename);
        }

        $em->flush();
        return $this->json($member, 200, [], ['groups' => 'member:read']);
    }

    // DELETE
    #[Route('/{id}', name: 'members_delete', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    public function delete(int $id, MemberRepository $repo, EntityManagerInterface $em): JsonResponse
    {
        $member = $repo->find($id);
        if (!$member) return $this->json(['error' => 'Member not found'], 404);

        $em->remove($member);
        $em->flush();

        return $this->json(['message' => 'Deleted'], 200);
    }
}