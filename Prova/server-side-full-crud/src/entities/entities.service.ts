import { Injectable } from '@nestjs/common';
import { PrismaService } from '../prisma/prisma.service';
import { CreateEntityDto } from './dto/create-entity.dto';
import { UpdateEntityDto } from './dto/update-entity.dto';

@Injectable()
export class EntitiesService {
  constructor(private prisma: PrismaService) {}
  create(createEntityDto: CreateEntityDto) {
    return this.prisma.entities.create({ data: createEntityDto });
  }

  async findAll() {
    return await this.prisma.entities.findMany();
  }

  async findOne(id: string) {
    const entity = await this.prisma.entities.findUnique({
      where: { id },
      rejectOnNotFound: true,
    });

    return entity;
  }

  update(id: string, updateEntityDto: UpdateEntityDto) {
    return this.prisma.entities.update({
      data: updateEntityDto,
      where: { id },
    });
  }

  remove(id: string) {
    return this.prisma.entities.delete({ where: { id } });
  }
}
